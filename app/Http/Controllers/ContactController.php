<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;    
use PhpParser\Node\Expr\AssignOp\Concat;

class ContactController extends Controller
{
    public function list()
    {
        $contact = Contact::when(request('search'),function($query,$search){
                $query->where('name','like', '%' . $search . '%');
        })->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.contact.list', [
            'contacts' => $contact,
        ]);
    }

    public function delete(Contact $contact)
    {
        $contact->delete();
        return back()->with('success', 'Contact was successfully deleted');
    }
}