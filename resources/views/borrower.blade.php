<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Borrower Information</title>
    <link rel="stylesheet" href="{{ asset('css/borrower.css') }}" />
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <a href="{{ route('dashboard') }}" class="btn btn-dark">Back to Dashboard</a>
            <h1>Borrower Information</h1>
            <form action="{{ route('logout') }}" method="POST" class="logout-form" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Log Out</button>
            </form>
        </div>

        <!-- Form Section -->
        <div class="form-container">
            <form id="borrower-form" method="POST" action="{{ route('borrowers.store') }}">
                @csrf
                <input type="hidden" id="borrower_id" name="id" value="">

                <!-- Row 1 -->
                <div class="form-grid form-grid-4">
                    <div class="form-group">
                        <label for="member_id">Member ID</label>
                        <input type="text" id="member_id" name="member_id" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" class="form-control" required />
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="form-grid form-grid-4">
                    <div class="form-group">
                        <label for="book_id">Book ID</label>
                        <input type="text" id="book_id" name="book_id" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="mobile_phone">Mobile Phone</label>
                        <input type="text" id="mobile_phone" name="mobile_phone" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="member_type">Member Type</label>
                        <select id="member_type" name="member_type" class="form-control" required>
                            <option value="">Select Type</option>
                            <option value="student">Student</option>
                            <option value="faculty">Faculty</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="book_status">Book Status</label>
                        <select id="book_status" name="book_status" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="borrowed">Borrowed</option>
                            <option value="returned">Returned</option>
                            <option value="overdue">Overdue</option>
                        </select>
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="form-grid form-grid-3">
                    <div class="form-group">
                        <label for="borrow_date">Borrow Date</label>
                        <input type="date" id="borrow_date" name="borrow_date" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input type="date" id="due_date" name="due_date" class="form-control highlighted" required />
                    </div>
                    <div class="form-group">
                        <label for="return_date">Return Date</label>
                        <input type="date" id="return_date" name="return_date" class="form-control" />
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="form-actions">
                    <button type="submit" id="btn-add" class="btn btn-success">Add</button>
                    <button type="button" id="btn-update" class="btn btn-warning" style="display:none;">Update</button>
                    <button type="button" id="btn-delete" class="btn btn-danger" style="display:none;">Delete</button>
                    <button type="button" id="btn-cancel" class="btn btn-secondary" style="display:none;">Cancel</button>
                </div>
            </form>
        </div>

        <!-- Data Table -->
        <div class="table-container">
            <div class="table-wrapper">
                <table id="borrower-table">
                    <thead>
                        <tr>
                            <th>Member ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>Book ID</th>
                            <th>Mobile Phone</th>
                            <th>Member Type</th>
                            <th>Book Status</th>
                            <th>Borrow Date</th>
                            <th>Due Date</th>
                            <th>Return Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($borrowers as $borrower)
                        <tr 
                            data-id="{{ $borrower->id }}"
                            data-member_id="{{ $borrower->member_id }}"
                            data-first_name="{{ $borrower->first_name }}"
                            data-last_name="{{ $borrower->last_name }}"
                            data-address="{{ $borrower->address }}"
                            data-book_id="{{ $borrower->book_id }}"
                            data-mobile_phone="{{ $borrower->mobile_phone }}"
                            data-member_type="{{ $borrower->member_type }}"
                            data-book_status="{{ $borrower->book_status }}"
                            data-borrow_date="{{ $borrower->borrow_date }}"
                            data-due_date="{{ $borrower->due_date }}"
                            data-return_date="{{ $borrower->return_date }}"
                        >
                            <td>{{ $borrower->member_id }}</td>
                            <td>{{ $borrower->first_name }}</td>
                            <td>{{ $borrower->last_name }}</td>
                            <td>{{ $borrower->address }}</td>
                            <td>{{ $borrower->book_id }}</td>
                            <td>{{ $borrower->mobile_phone }}</td>
                            <td>{{ ucfirst($borrower->member_type) }}</td>
                            <td>{{ ucfirst($borrower->book_status) }}</td>
                            <td>{{ $borrower->borrow_date }}</td>
                            <td>{{ $borrower->due_date }}</td>
                            <td>{{ $borrower->return_date }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="11" style="text-align:center;">No borrowers found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<script>
    const form = document.getElementById('borrower-form');
    const btnAdd = document.getElementById('btn-add');
    const btnUpdate = document.getElementById('btn-update');
    const btnDelete = document.getElementById('btn-delete');
    const btnCancel = document.getElementById('btn-cancel');

    const borrowerId = document.getElementById('borrower_id');
    const memberId = document.getElementById('member_id');
    const firstName = document.getElementById('first_name');
    const lastName = document.getElementById('last_name');
    const address = document.getElementById('address');
    const bookId = document.getElementById('book_id');
    const mobilePhone = document.getElementById('mobile_phone');
    const memberType = document.getElementById('member_type');
    const bookStatus = document.getElementById('book_status');
    const borrowDate = document.getElementById('borrow_date');
    const dueDate = document.getElementById('due_date');
    const returnDate = document.getElementById('return_date');

    function resetForm() {
        borrowerId.value = '';
        memberId.value = '';
        firstName.value = '';
        lastName.value = '';
        address.value = '';
        bookId.value = '';
        mobilePhone.value = '';
        memberType.value = '';
        bookStatus.value = '';
        borrowDate.value = '';
        dueDate.value = '';
        returnDate.value = '';

        form.action = "{{ route('borrowers.store') }}";
        form.method = "POST";

        btnAdd.style.display = 'inline-block';
        btnUpdate.style.display = 'none';
        btnDelete.style.display = 'none';
        btnCancel.style.display = 'none';

        const methodInput = form.querySelector('input[name="_method"]');
        if(methodInput) methodInput.remove();
    }

    document.querySelectorAll('#borrower-table tbody tr[data-id]').forEach(row => {
        row.addEventListener('click', () => {
            borrowerId.value = row.dataset.id;
            memberId.value = row.dataset.member_id;
            firstName.value = row.dataset.first_name;
            lastName.value = row.dataset.last_name;
            address.value = row.dataset.address;
            bookId.value = row.dataset.book_id;
            mobilePhone.value = row.dataset.mobile_phone;
            memberType.value = row.dataset.member_type;
            bookStatus.value = row.dataset.book_status;
            borrowDate.value = row.dataset.borrow_date;
            dueDate.value = row.dataset.due_date;
            returnDate.value = row.dataset.return_date;

            form.action = `/borrowers/${borrowerId.value}`;
            form.method = "POST";

            let methodInput = form.querySelector('input[name="_method"]');
            if(!methodInput){
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                form.appendChild(methodInput);
            }
            methodInput.value = 'PUT';

            btnAdd.style.display = 'none';
            btnUpdate.style.display = 'inline-block';
            btnDelete.style.display = 'inline-block';
            btnCancel.style.display = 'inline-block';
        });
    });

    btnCancel.addEventListener('click', () => {
        resetForm();
    });

    btnUpdate.addEventListener('click', () => {
        form.submit();
    });

    btnDelete.addEventListener('click', () => {
        if (!confirm('Are you sure you want to delete this borrower?')) return;

        const id = borrowerId.value;
        if (!id) {
            alert('No borrower selected for deletion.');
            return;
        }

        const deleteForm = document.createElement('form');
        deleteForm.method = 'POST';
        deleteForm.action = `/borrowers/${id}`;
        deleteForm.style.display = 'none';

        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        deleteForm.appendChild(csrfInput);

        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        deleteForm.appendChild(methodInput);

        document.body.appendChild(deleteForm);
        deleteForm.submit();
    });

    resetForm();
</script>
</body>
</html>
