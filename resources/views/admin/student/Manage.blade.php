{{-- resources/views/admin/students/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Student Management')

@section('page_title')
Students
@endsection

@section('breadcrumb')
Home / User Management / Students
@endsection


@section('styles')
<style>
    /* Student Management Specific Styles */
    .students-content {
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

    .filter-dropdown, .sort-dropdown {
        position: relative;
    }

    .filter-btn, .sort-btn {
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

    .filter-btn:hover, .sort-btn:hover {
        border-color: #3498db;
        color: #3498db;
    }

    .add-student-btn {
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

    .add-student-btn:hover {
        background: #2980b9;
        transform: translateY(-2px);
        color: white;
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
    .stat-card.grades { --card-color: #f39c12; }
    .stat-card.new { --card-color: #9b59b6; }

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

    /* Students Table */
    .students-table-container {
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

    .students-table {
        width: 100%;
        border-collapse: collapse;
    }

    .students-table th {
        background: #f8fafc;
        padding: 15px 20px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        color: #4a5568;
        border-bottom: 1px solid #e2e8f0;
    }

    .students-table td {
        padding: 20px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .students-table tr:hover {
        background: #f8fafc;
    }

    .student-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .student-avatar {
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

    .student-details h4 {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 2px;
    }

    .student-details p {
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

    .status-badge.suspended {
        background: #fff3cd;
        color: #856404;
    }

    .grade-tag {
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
        background-color: #00a11bff;
        color: white;
    }

    .action-buttons form button:hover {
        background-color: #9ce284ff;
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
    @media (max-width: 768px) {
        .students-content {
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

        .students-table {
            font-size: 13px;
        }

        .students-table th,
        .students-table td {
            padding: 12px 8px;
        }

        .student-info {
            flex-direction: column;
            text-align: center;
            gap: 10px;
        }
    }
   
</style>
@endsection

@section('content')
<!-- Students Content -->
<div class="students-content">
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
            <a href="{{ route('addstudent')}}" class="add-student-btn">
                <i class="fas fa-plus"></i>
                Add Student
            </a>
        </div>
            <div class="action-right">
            <a href="{{ route('index')}}" class="add-student-btn">
                <i class="fas fa-eye"></i>
                View Student
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
            <div class="stat-number">{{ $totalStudents ?? '1,247' }}</div>
            <div class="stat-label">Total Students</div>
        </div>

        <div class="stat-card active">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
            <div class="stat-number">{{ $activeStudents ?? '1,156' }}</div>
            <div class="stat-label">Active Students</div>
        </div>

        <div class="stat-card grades">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-layer-group"></i>
                </div>
            </div>
            <div class="stat-number">{{ $totalGrades ?? '12' }}</div>
            <div class="stat-label">Grade Levels</div>
        </div>

        <div class="stat-card new">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>
            <div class="stat-number">{{ $newStudents ?? '45' }}</div>
            <div class="stat-label">New This Month</div>
        </div>
    </div>

    <!-- Students Table -->
    <div class="students-table-container">
        <div class="table-header">
            <h3 class="table-title">All Students</h3>
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
           
        <table class="students-table">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Student ID</th>
                    <th>Grade/Class</th>
                    <th>Parent Contact</th>
                    <th>Status</th>
                    <th>Admission Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="studentsTableBody">
                @if(isset($students) && $students->count() > 0)
                    @foreach($students as $student)
                        <tr>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">
                                        {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                                    </div>
                                    <div class="student-details">
                                        <h4>{{ $student->first_name }} {{ $student->last_name }}</h4>
                                        <p>{{ $student->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $student->student_id }}</td>
                            <td>
                                <span class="grade-tag">{{ $student->schoolClass->name ?? 'Grade 10' }}</span>
                            </td>
                            <td>{{ $student->parent_phone ?? $student->phone }}</td>
                            <td>
                                <span class="status-badge {{ strtolower($student->status) }}">
                                    {{ $student->status }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($student->admission_date ?? $student->created_at)->format('d M Y') }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('students.edit', $student->id) }}">Edit</a>
                                     <a href="{{ route('bio', $student->id) }}" class="btn btn-view">View</a>
                            </td>
                        </tr>
                    @endforeach
       
                @endif
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
    // Student Management JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        // Global search functionality
        const globalSearch = document.getElementById('globalSearch');
        if (globalSearch) {
            globalSearch.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const rows = document.querySelectorAll('#studentsTableBody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }

        // Export functionality
        const exportBtn = document.querySelector('.table-btn');
        if (exportBtn) {
            exportBtn.addEventListener('click', function() {
                // Implement export functionality
                alert('Export functionality would be implemented here');
            });
        }

        // Print functionality
        const printBtn = document.querySelectorAll('.table-btn')[1];
        if (printBtn) {
            printBtn.addEventListener('click', function() {
                window.print();
            });
        }

        // Filter and sort functionality
        const filterBtn = document.getElementById('filterBtn');
        const sortBtn = document.getElementById('sortBtn');

        if (filterBtn) {
            filterBtn.addEventListener('click', function() {
                // Implement filter functionality
                alert('Filter options would be implemented here');
            });
        }

        if (sortBtn) {
            sortBtn.addEventListener('click', function() {
                // Implement sort functionality
                alert('Sort options would be implemented here');
            });
        }
    });

    // Delete confirmation
    function confirmDelete(studentName) {
        return confirm(`Are you sure you want to delete ${studentName}? This action cannot be undone.`);
    }
</script>
@endsection