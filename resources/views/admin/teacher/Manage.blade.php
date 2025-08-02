@extends('layouts.app')

@section('title', 'Teacher Management - EduManage')

@section('page_title')
Teachers
@endsection

@section('breadcrumb')
Home / User Management / Teachers
@endsection

@section('styles')
<style>
    /* Teacher Management Content */
    .teachers-content {
        padding: 30px;
    }

    /* Action Bar */
    .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        gap: 20px;
        flex-wrap: wrap;
    }

    .action-left {
        display: flex;
        gap: 15px;
        align-items: center;
        flex: 1;
    }

    .action-right {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .filter-dropdown {
        position: relative;
    }

    .filter-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        border: 1px solid #e2e8f0;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-btn:hover {
        border-color: #3498db;
        color: #3498db;
    }

    .sort-dropdown {
        position: relative;
    }

    .sort-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        border: 1px solid #e2e8f0;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .sort-btn:hover {
        border-color: #3498db;
        color: #3498db;
    }

    .add-teacher-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        background: #3498db;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .add-teacher-btn:hover {
        background: #2980b9;
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--card-color);
    }

    .stat-card.total { --card-color: #3498db; }
    .stat-card.active { --card-color: #2ecc71; }
    .stat-card.departments { --card-color: #f39c12; }
    .stat-card.pending { --card-color: #e74c3c; }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
        background: var(--card-color);
    }

    .stat-number {
        font-size: 28px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 14px;
        color: #718096;
        font-weight: 500;
    }

    /* Teachers Table */
    .teachers-table-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .table-header {
        padding: 25px 30px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-title {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
    }

    .table-actions {
        display: flex;
        gap: 10px;
    }

    .table-btn {
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
        background: white;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .table-btn:hover {
        border-color: #3498db;
        color: #3498db;
    }

    .teachers-table {
        width: 100%;
        border-collapse: collapse;
    }

    .teachers-table th {
        background: #f8fafc;
        padding: 15px 20px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        color: #4a5568;
        border-bottom: 1px solid #e2e8f0;
    }

    .teachers-table td {
        padding: 20px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .teachers-table tr:hover {
        background: #f8fafc;
    }

    .teacher-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .teacher-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3498db, #2980b9);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 16px;
    }

    .teacher-details h4 {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 2px;
    }

    .teacher-details p {
        font-size: 13px;
        color: #718096;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-badge.active {
        background: #d4edda;
        color: #155724;
    }

    .status-badge.inactive {
        background: #f8d7da;
        color: #721c24;
    }

    .status-badge.pending {
        background: #fff3cd;
        color: #856404;
    }

    .department-tag {
        display: inline-block;
        padding: 4px 8px;
        background: #e3f2fd;
        color: #1976d2;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .action-buttons a,
    .action-buttons form button {
        padding: 6px 12px;
        font-size: 14px;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
        margin-right: 5px;
        transition: background-color 0.2s ease;
    }

    .action-buttons a {
        background-color: #3498db;
        color: white;
    }

    .action-buttons a:hover {
        background-color: #2980b9;
    }

    .action-buttons form button {
        background-color: #e74c3c;
        color: white;
    }

    .action-buttons form button:hover {
        background-color: #c0392b;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 30px;
        padding: 20px 0;
    }

    .pagination-btn {
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
        background: white;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .pagination-btn:hover,
    .pagination-btn.active {
        background: #3498db;
        color: white;
        border-color: #3498db;
    }

    .pagination-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .teachers-content {
            padding: 20px;
        }

        .action-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .action-left,
        .action-right {
            justify-content: center;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .teachers-table {
            font-size: 13px;
        }

        .teachers-table th,
        .teachers-table td {
            padding: 12px 8px;
        }

        .teacher-info {
            flex-direction: column;
            text-align: center;
            gap: 10px;
        }
    }
</style>
@endsection

@section('content')
<!-- Teachers Content -->
<div class="teachers-content">
    <!-- Action Bar -->
    <div class="action-bar">
        <div class="action-left">
            <div class="filter-dropdown">
                <button class="filter-btn" id="filterBtn">
                    <i class="fas fa-filter"></i>
                    Filter
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
            
            <div class="sort-dropdown">
                <button class="sort-btn" id="sortBtn">
                    <i class="fas fa-sort"></i>
                    Sort by Name
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
        </div>

        <div class="action-right">
            <a href="{{ route('addteacher') }}" class="add-teacher-btn" id="addTeacherBtn">
                <i class="fas fa-plus"></i>
                Add Teacher
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card total">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-number">{{ $totalTeachers ?? 0 }}</div>
            <div class="stat-label">Total Teachers</div>
        </div>

        <div class="stat-card active">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
            <div class="stat-number">{{ $activeTeachers ?? 0 }}</div>
            <div class="stat-label">Active Teachers</div>
        </div>

        <div class="stat-card departments">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-building"></i>
                </div>
            </div>
            <div class="stat-number">12</div>
            <div class="stat-label">Departments</div>
        </div>

        <div class="stat-card pending">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <div class="stat-number">8</div>
            <div class="stat-label">Pending Approval</div>
        </div>
    </div>

    <!-- Teachers Table -->
    <div class="teachers-table-container">
        <div class="table-header">
            <h3 class="table-title">All Teachers</h3>
            <div class="table-actions">
                <button class="table-btn">
                    <i class="fas fa-download"></i>
                    Export
                </button>
                <button class="table-btn">
                    <i class="fas fa-print"></i>
                    Print
                </button>
            </div>
        </div>

        <table class="teachers-table">
            <thead>
                <tr>
                    <th>Teacher</th>
                    <th>Employee ID</th>
                    <th>Department</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Joined Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="teachersTableBody">
                @foreach($teachers ?? [] as $teacher)
                    <tr>
                        <td>
                            <div class="teacher-info">
                                <div class="teacher-avatar">
                                    {{ strtoupper(substr($teacher->first_name, 0, 1) . substr($teacher->last_name, 0, 1)) }}
                                </div>
                                <div class="teacher-details">
                                    <h4>{{ $teacher->first_name }} {{ $teacher->last_name }}</h4>
                                    <p>{{ $teacher->email ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ $teacher->employee_id }}</td>
                        <td>
                            <span class="department-tag">{{ $teacher->department }}</span>
                        </td>
                        <td>{{ $teacher->phone }}</td>
                        <td>        
                            @if($teacher->status === 'Active')
                                <span class="status-badge active">Active</span>
                            @else
                                <span class="status-badge inactive">Inactive</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($teacher->join_date)->format('d M Y') }}</td>
                        <td class="action-buttons">
                            <a href="{{ route('teacher.edit', $teacher->id) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <button class="pagination-btn" id="prevBtn">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="pagination-btn active">1</button>
            <button class="pagination-btn">2</button>
            <button class="pagination-btn">3</button>
            <button class="pagination-btn">4</button>
            <button class="pagination-btn" id="nextBtn">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Global search functionality
    const globalSearch = document.getElementById('globalSearch');
    if (globalSearch) {
        globalSearch.addEventListener('input', handleSearch);
    }

    // Handle search
    function handleSearch(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#teachersTableBody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Filter and sort functionality can be added here
    const filterBtn = document.getElementById('filterBtn');
    const sortBtn = document.getElementById('sortBtn');

    if (filterBtn) {
        filterBtn.addEventListener('click', function() {
            // Add filter functionality
            console.log('Filter clicked');
        });
    }

    if (sortBtn) {
        sortBtn.addEventListener('click', function() {
            // Add sort functionality
            console.log('Sort clicked');
        });
    }
</script>
@endsection