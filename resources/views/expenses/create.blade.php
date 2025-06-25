<x-app-layout>
    <div class="container">
        <h2>Add New Expense</h2>

        <form action="{{ route('expenses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('expenses.partials.form', ['expense' => null])

            <button type="submit" class="btn btn-primary mt-3">Save Expense</button>
        </form>
    </div>
</x-app-layout>
