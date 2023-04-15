<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        $employees = Employee::latest()->when(request()->q, function($employees) {
            $employees = $employees->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('dashboard.employee.index', compact('employees'));
    }

    public function create() {
        return view('dashboard.employee.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email:rfc,dns|unique:employees',
            'phone' => 'required|numeric|min:10|unique:employees',
            'address' => 'required'
        ]);

        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        if($employee) {
            return redirect()->route('dashboard.employee.index')->with(['success' => 'Data Saved Successfully!']);
        } else {
            return redirect()->route('dashboard.employee.create')->with(['error' => 'Data Failed to Save!']);
        }
    }

    public function edit(Employee $employee) {
        return view('dashboard.employee.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee) {
        $this->validate($request, [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email:rfc,dns|unique:employees,email,' . $employee->id,
            'phone' => 'required|numeric|min:10|unique:employees,phone,' . $employee->id,
            'address' => 'required'
        ]);

        $employee = Employee::findOrFail($employee->id);
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        if($employee) {
            return redirect()->route('dashboard.employee.index')->with(['success' => 'Data Updated Successfully!']);
        } else {
            return redirect()->route('dashboard.employee.edit')->with(['error' => 'Data Failed to Save!']);
        }
    }

    public function destroy($id) {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        if($employee) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
