<?php

namespace App\Policies;

use App\Models\Offer;
use App\Models\Order;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Route;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function superadmin(User $user)
    {
        $user = auth()->user();
        return $user->user_type == "superadmin" ? true : false;
    }

    public function super_admin_marketer(User $user)
    {
        $user = auth()->user();
        return $user->user_type == "superadmin" || $user->user_type == "marketer" || $user->user_type == "admin" ? true : false;
    }

    public function users(User $user)
    {
        return $user->permissions['users'];
    }
    public function cities(User $user)
    {
        return $user->permissions['cities'];
    }
    public function neighborhoods(User $user)
    {
        return $user->permissions['neighborhoods'];
    }
    public function reservations(User $user)
    {
        return $user->permissions['reservations'];
    }
    public function clients(User $user)
    {
        return $user->permissions['clients'];
    }
    public function branches(User $user)
    {
        return $user->permissions['branches'];
    }
    public function sms(User $user)
    {
        return $user->permissions['sms'];
    }
    public function mediators(User $user)
    {
        return $user->permissions['mediators'];
    }
    public function directOffers(User $user)
    {
        return $user->permissions['direct_offers'];
    }

    public function indirectOffers(User $user)
    {
        return $user->permissions['indirect_offers'];
    }

    public function orders(User $user)
    {
        return $user->permissions['orders'];
    }

    public function assignedOrders(User $user)
    {
        return $user->permissions['orders'] && $user->user_type == "marketer" ? true : false;
    }

    public function sales(User $user)
    {
        return $user->permissions['sales'];
    }

    //User
    public function viewUser(User $user)
    {
        return $user->permissions['can_show_user'];
    }

    public function createUser(User $user)
    {
        return $user->permissions['can_add_user'];
    }

    public function updateUser(User $user)
    {
        return $user->permissions['can_edit_user'];
    }

    public function deleteUser(User $user)
    {
        return $user->permissions['can_delete_user'];
    }

    public function statusUser(User $user)
    {
        return $user->permissions['can_change_user_status'];
    }

    //Order
    public function viewOrder(User $user)
    {
        return $user->permissions['can_show_order'];
    }

    public function createOrder(User $user)
    {
        $user = auth()->user();

        if (Route::currentRouteName() == 'panel.orders.assigned' && $user->user_type == "marketer") {
            return false;
        }

        return $user->permissions['can_add_order'];
    }

    public function updateOrder(User $user, $order_id)
    {
        $user = auth()->user();

        if (Route::currentRouteName() == 'panel.orders.assigned' && $user->user_type == "marketer") {
            return false;
        }

        if ($user->user_type == "office" && $order_id) {
            $order = Order::where('user_id', $user->id)->where('id', $order_id)->first();
            return $user->permissions['can_edit_order'] && $order ? true : false;
        }

        if ($user->user_type == "marketer" && $order_id) {
            $order = Order::where('user_id', $user->id)->where('id', $order_id)->first();
            return $user->permissions['can_edit_order'] && $order ? true : false;
        }

        if ($user->user_type == "admin" && $order_id) {
            $order = Order::where('user_id', $user->id)->where('id', $order_id)->first();
            return $user->permissions['can_edit_order'] && $order ? true : false;
        }

        return $user->permissions['can_edit_order'];
    }

    public function deleteOrder(User $user, $order_id)
    {
        if (Route::currentRouteName() == 'panel.orders.assigned' && $user->user_type == "marketer") {
            return false;
        }

        if ($user->user_type == "office" && $order_id) {
            $order = Order::where('user_id', $user->id)->where('id', $order_id)->first();
            return $user->permissions['can_delete_order'] && $order ? true : false;
        }

        if ($user->user_type == "marketer" && $order_id) {
            $order = Order::where('user_id', $user->id)->where('id', $order_id)->first();
            return $user->permissions['can_delete_order'] && $order ? true : false;
        }

        if ($user->user_type == "admin" && $order_id) {
            $order = Order::where('user_id', $user->id)->where('id', $order_id)->first();
            return $user->permissions['can_delete_order'] && $order ? true : false;
        }

        return $user->permissions['can_delete_order'];
    }

    public function statusOrder(User $user)
    {
        return $user->permissions['can_change_order_status'];
    }

    public function orderEditors(User $user)
    {
        return $user->user_type == "superadmin" || $user->user_type == "admin" ? true : false;
    }

    //Offer

    public function viewOffer(User $user, $offer_id)
    {
        return $user->permissions['can_show_offer'];
    }

    public function createOffer(User $user)
    {
        return $user->permissions['can_add_offer'];
    }

    public function updateOffer(User $user, $offer_id)
    {
        if ($user->user_type == "office" && $offer_id) {
            $offer = Offer::where('user_id', $user->id)->where('id', $offer_id)->first();
            return $user->permissions['can_edit_offer'] && $offer ? true : false;
        }

        if ($user->user_type == "marketer" && $offer_id) {
            $offer = Offer::where('user_id', $user->id)->where('id', $offer_id)->first();
            return $user->permissions['can_edit_offer'] && $offer ? true : false;
        }

        if ($user->user_type == "admin" && $offer_id) {
            $offer = Offer::where('user_id', $user->id)->where('id', $offer_id)->first();
            return $user->permissions['can_edit_offer'] && $offer ? true : false;
        }

        return $user->permissions['can_edit_offer'];
    }

    public function deleteOffer(User $user, $offer_id)
    {
        if ($user->user_type == "office" && $offer_id) {
            $offer = Offer::where('user_id', $user->id)->where('id', $offer_id)->first();
            return $user->permissions['can_delete_offer'] && $offer ? true : false;
        }

        if ($user->user_type == "marketer" && $offer_id) {
            $offer = Offer::where('user_id', $user->id)->where('id', $offer_id)->first();
            return $user->permissions['can_delete_offer'] && $offer ? true : false;
        }

        if ($user->user_type == "admin" && $offer_id) {
            $offer = Offer::where('user_id', $user->id)->where('id', $offer_id)->first();
            return $user->permissions['can_delete_offer'] && $offer ? true : false;
        }

        return $user->permissions['can_delete_offer'];
    }

    public function statusOffer(User $user)
    {
        return $user->permissions['can_change_offer_status'];
    }

    //Sale

    public function viewSale(User $user)
    {
        return $user->permissions['can_show_sale'];
    }

    public function createSale(User $user)
    {
        return $user->permissions['can_add_sale'];
    }

    public function updateSale(User $user, $sale_id)
    {
        if ($user->user_type == "office" && $sale_id) {
            $sale = Sale::where('user_id', $user->id)->where('id', $sale_id)->first();
            return $user->permissions['can_edit_sale'] && $sale ? true : false;
        }

        if ($user->user_type == "marketer" && $sale_id) {
            $sale = Sale::where('user_id', $user->id)->where('id', $sale_id)->first();
            return $user->permissions['can_edit_sale'] && $sale ? true : false;
        }

        if ($user->user_type == "admin" && $sale_id) {
            $sale = Sale::where('user_id', $user->id)->where('id', $sale_id)->first();
            return $user->permissions['can_edit_sale'] && $sale ? true : false;
        }

        return $user->permissions['can_edit_sale'];
    }

    public function deleteSale(User $user, $sale_id)
    {
        if ($user->user_type == "office" && $sale_id) {
            $sale = Offer::where('user_id', $user->id)->where('id', $sale_id)->first();
            return $user->permissions['can_delete_sale'] && $sale ? true : false;
        }

        if ($user->user_type == "marketer" && $sale_id) {
            $sale = Offer::where('user_id', $user->id)->where('id', $sale_id)->first();
            return $user->permissions['can_delete_sale'] && $sale ? true : false;
        }

        if ($user->user_type == "admin" && $sale_id) {
            $sale = Sale::where('user_id', $user->id)->where('id', $sale_id)->first();
            return $user->permissions['can_delete_sale'] && $sale ? true : false;
        }

        return $user->permissions['can_delete_sale'];
    }

    public function statusSale(User $user)
    {
        return $user->permissions['can_change_sale_status'];
    }

    //Client

    public function viewClient(User $user)
    {
        return true;
    }

    public function createClient(User $user)
    {
        return true;
    }

    public function updateClient(User $user)
    {
        return true;
    }

    public function deleteClient(User $user)
    {
        return true;
    }

    public function statusClient(User $user)
    {
        return true;
    }

    //City

    public function viewCity(User $user)
    {
        return true;
    }

    public function createCity(User $user)
    {
        return true;
    }

    public function updateCity(User $user)
    {
        return true;
    }

    public function deleteCity(User $user)
    {
        return true;
    }

    public function statusCity(User $user)
    {
        return true;
    }

    //Neighborhood

    public function viewNeighborhood(User $user)
    {
        return true;
    }

    public function createNeighborhood(User $user)
    {
        return true;
    }

    public function updateNeighborhood(User $user)
    {
        return true;
    }

    public function deleteNeighborhood(User $user)
    {
        return true;
    }

    public function statusNeighborhood(User $user)
    {
        return true;
    }

    //Reservation

    public function viewReservation(User $user)
    {
        return true;
    }

    public function createReservation(User $user)
    {
        return true;
    }

    public function updateReservation(User $user)
    {
        return true;
    }

    public function deleteReservation(User $user)
    {
        return true;
    }

    public function statusReservation(User $user)
    {
        return true;
    }

    //Branch

    public function viewBranch(User $user)
    {
        return true;
    }

    public function createBranch(User $user)
    {
        return true;
    }

    public function updateBranch(User $user)
    {
        return true;
    }

    public function deleteBranch(User $user)
    {
        return true;
    }

    public function statusBranch(User $user)
    {
        return true;
    }

    //Broker

    public function viewBroker(User $user)
    {
        return true;
    }

    public function createBroker(User $user)
    {
        return true;
    }

    public function updateBroker(User $user)
    {
        return true;
    }

    public function deleteBroker(User $user)
    {
        return true;
    }

    public function statusBroker(User $user)
    {
        return true;
    }
}
