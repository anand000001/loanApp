<?php

namespace App\Http\Controllers;
use App\Models\PersonalLoan;

use Illuminate\Http\Request;

class PersonalLoanController extends Controller
{
    public function index()
    {
        $loans = PersonalLoan::all();
        return view('personalloan.index', compact('loans')); // Pass data to the Blade view
    }    

    // Show the form for creating a new loan
    public function create()
    {
        return view('personalloan.create'); // Assuming you have a Blade template
    }

    // Store a new loan
    public function store(Request $request)
    {
        // Remove the validation and directly create the loan
        $loan = PersonalLoan::create([
            'customer_id' => $request['customer_id'],
            'agent_id' => $request['agent_id'],
            'loan_amount' => $request['loan_amount'],
            'interest_rate' => $request['interest_rate'],
            'type' => $request['type'],
            'collected_amount' => $request['collected_amount'] ?? 0,
            'duration' => $request['duration'],
            'disburse_date' => $request['disburse_date'],
        ]);
    
        // Redirect to the index page with a success message
        return redirect()->route('personalloans.index')->with('success', 'Personal Loan created successfully!');
    } 
    
   
    public function edit($id)
    {
        $loan = PersonalLoan::findOrFail($id);
        return view('personalloans.edit', compact('loan'));
    }

   
    public function update(Request $request, $id)
    {

        $loan = PersonalLoan::findOrFail($id);
        $loan->update($request->all());

        return redirect()->route('personalloans.index')->with('success', 'Loan updated successfully.');
    }

    public function destroy($id)
    {
        $loan = PersonalLoan::findOrFail($id);
        $loan->delete();

        return redirect()->route('personalloans.index')->with('success', 'Loan deleted successfully.');
    }
}
    