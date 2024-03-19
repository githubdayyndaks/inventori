namespace App\Events;

use App\Models\Barang;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BarangPeminjamanCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $barang;

    public function __construct(Barang $barang)
    {
        $this->barang = $barang;
    }
}
