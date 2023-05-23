<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request, Product $product)
    {
        $validated = $request->validate([
            'comment' => ['required', 'string', 'min:10', 'max:50'],
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
        ]);

        $feedback = new Feedback;
        $feedback->comment = $validated['comment'];
        $feedback->rating = $validated['rating'];

        $feedback->user_id = auth()->user()->id;
        $product->feedbacks()->save($feedback);

        return redirect()->back()->with('success', 'Thank you for rating the product.');
    }

    public function delete(Request $request)
    {
        $feedback = Feedback::query()
            ->where('user_id', auth()->user()->id)->get();
        if ($feedback) {
            $feedback->toQuery()->delete();
            return redirect()->back()->with('success', 'You have deleted your comment.');
        } else {
            return redirect()->back()->with('error', 'Comment not found.');
        }
    }

}
