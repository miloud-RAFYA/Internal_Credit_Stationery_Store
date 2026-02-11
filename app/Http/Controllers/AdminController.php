<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Produit;
use App\Models\User;
use App\Models\Manager;
use App\Models\Commande;
use App\Models\Departement;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'totalProduits' => Produit::count(),
            'totalUsers' => User::whereRelation('role', 'nom', '!=', 'admin')->count(),
            'totalTokens' => Manager::sum('token'),
        ];

        $commandes = Commande::latest()->paginate(5);
        return view('admin/finance/dashboard', compact('stats', 'commandes'));
    }

    // public function showProduits()
    // {
    //     $produits = Produit::latest()->get(); 
    //     return view('admin/produits', compact('produits'));
    // }

    public function showUtilisateurs()
    {
        $utilisateurs = User::with('employe')->get(); 

        $stats = [
            'total_users' => $utilisateurs->count(),
            'total_tokens' => $utilisateurs->sum(function($user) {
                return $user->employe->token ?? 0;
            }),
        ];

        return view('admin.utilisateurs', compact('utilisateurs', 'stats'));
    }
    public function reports(Request $request)
    {
        $departements = Departement::orderBy('nom')->get();

        $query = Commande::with(['user.employe.departement']);

        // Filter by department (via user->employe->departement)
        if ($request->filled('departement_id')) {
            $deptId = $request->input('departement_id');
            $query->whereHas('user.employe', function ($q) use ($deptId) {
                $q->where('departement_id', $deptId);
            });
        }

        // Date range filters
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->input('start_date'));
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->input('end_date'));
        }

        $transactionsQuery = clone $query;

        // Totals
        $totalRevenue = (float) $transactionsQuery->sum('montant_tokens');
        $totalCommandes = (int) $transactionsQuery->count();
        $totalPremium = (boolean) $transactionsQuery->where('est_premuim', true)->count();

        // $pendingApprovals = Notification::where('status', 'non_lue')->count();

        // Export handling (CSV)
        if ($request->filled('export') && $request->input('export') === 'csv') {
            $rows = $query->orderBy('created_at', 'desc')->get();

            $filename = 'rapports_transactions_' . now()->format('Ymd_His') . '.csv';
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            ];

            $callback = function () use ($rows) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, ['Date', 'Departement', 'Utilisateur', 'Montant', 'Statut']);

                foreach ($rows as $r) {
                    $date = optional($r->created_at)->format('Y-m-d');
                    $dept = data_get($r, 'user.employe.departement.nom', '');
                    $user = data_get($r, 'user.nom', '');
                    $montant = $r->montant_tokens ?? 0;
                    $statut = $r->status ?? '';
                    fputcsv($handle, [$date, $dept, $user, $montant, $statut]);
                }

                fclose($handle);
            };

            return Response::stream($callback, 200, $headers);
        }

        $transactions = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('admin.finance.reports', compact(
            'departements',
            'transactions',
            'totalRevenue',
            'totalCommandes',
            'totalPremium',
            // 'pendingApprovals'
        ));
    }
}
