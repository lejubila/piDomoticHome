<?php
/**
 * User: david
 * Date: 06/01/18
 * Time: 11.27
 */

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ShippingStatusUpdated implements ShouldBroadcast
{

    /**
     * Information about the shipping status update.
     *
     * @var string
     */
    public $update;

    public function __construct($update)
    {
        $this->update = $update;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('order.'.$this->update->order_id);
    }


    /**
     * The event's broadcast name.
     * se definita il nome dell'evento non sarà il nome della classe ma bensì la stringa restituita dal metodo.
     * In questo modo nel listener js il nome dell'evento andrà anticipato da un punto .
     *
     * @return string
     */
    /*
    public function broadcastAs()
    {
        return 'shipping.status.updated';
    }
    */

    /**
     * Get the data to broadcast.
     * se definito come peyload dell'evento verranno inviati gli elementi dell'array restituito al posto
     * delle proprietà pubbliche della classe
     *
     * @return array
     */
    /*
    public function broadcastWith()
    {
        return ['id' => $this->user->id];
    }
    */

    /**
     * Determine if this event should broadcast.
     * se definito l'evento verrà inviato solo se il metodo restituisce un valore true
     *
     * @return bool
     */
    /*
    public function broadcastWhen()
    {
        return $this->value > 100;
    }
    */

}