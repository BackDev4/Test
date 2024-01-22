<?

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\TestEvent;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $message = $request->input('message');

        if (empty($message)) {
            return response()->json(['message' => 'Message is empty']);
        }

        $event = new TestEvent($message);
        $eventDispatched = event($event);

        if ($eventDispatched) {
            return response()->json(['message' => 'Event dispatched successfully']);
        } else {
            return response()->json(['message' => 'Event not dispatched']);
        }
    }
}
