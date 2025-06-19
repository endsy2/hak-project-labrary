<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Management System</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
  <header class="header">
    <h1 class="system-title">Library Management System</h1>
    <form action="{{ route('logout') }}" method="POST" class="logout-form">
      @csrf
      <button type="submit" class="logout-btn">Log Out</button>
    </form>
  </header>

  <main class="dashboard">
    <div class="dashboard-card">
      <h2 class="dashboard-title">Dashboard</h2>
      <div class="action-buttons">
        <a href="{{ route('bookinformation') }}" class="action-btn book-btn">Book Information</a>
        <a href="{{ route('borrowers.index') }}" class="action-btn borrower-btn">Borrower Information</a>

      </div>
    </div>
  </main>
</body>

</html>