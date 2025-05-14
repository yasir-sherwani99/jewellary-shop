<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Interfaces\UserRepositoryInterface;

use App\Helpers\CustomHelper;

class UserController extends Controller
{
    protected $user;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->user = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get users stats
        $stats = $this->user->getUsersStats();

        $datesData = [];
        $userDates = [];
        $months = now()->subMonths(12)->monthsUntil(now());
        
        foreach ($months as $mon) {

            $datesData[] = [
                'month' => $mon->month,
                'year' => $mon->year,
            ];

            $date = $mon->format('M Y');
            array_push($userDates, $date);

        }

        $userDatesFinal = json_encode($userDates);
        $userData = json_encode($this->user->countMonthWiseUsers($datesData));

        return view('pages.admin.users.index', [
            'stats' => $stats,
            'userDates' => $userDatesFinal,
            'userData' => $userData
        ]);
    }

    public function getAllUsers()
    {
        $userArray = [];

        $users = $this->user->getAllUsers();

        if(count($users) > 0) {
            foreach($users as $key => $user) {
                
                $firstInitial = CustomHelper::getNameInitials($user->first_name);
                $lastInitial = CustomHelper::getNameInitials($user->last_name);
                $fullInitial = $firstInitial . $lastInitial;

                $profileImage = "<span class=\"thumb-md justify-content-center d-inline-flex align-items-center bg-soft-purple rounded-circle me-2\">{$fullInitial}</span>";

                // $userDetails = "<a href=\"/user/{$user->id}/profile\">" . $user->first_name . "&nbsp;" . $user->last_name . "<br/><small>" . $user->email . "</small></a>";

                $userArray[] = [
                    'image' => $profileImage,
                    'name' => $user->first_name . ' ' . $user->last_name,
                    'email' => $user->email,
                    'total_orders' => $user->orders_count,
                    'details' => $user->id
                ];
            }
        }

        return json_encode($userArray);
    }
}
