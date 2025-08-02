@extends('layouts.teacher')

@section('title', 'Teacher Dashboard - EduManage')

@section('page-title', 'Dashboard')

@section('breadcrumb', 'Home / Dashboard')

@section('styles')
<style>
/* Modern Full-Width Dashboard Design with Enhanced Responsiveness */

/* Reset and base styles */
* {
    box-sizing: border-box;
}

/* Viewport meta tag for proper mobile scaling */
html {
    -webkit-text-size-adjust: 90%;
    -ms-text-size-adjust: 90%;
}

/* Flexible container system */
.container, 
.container-fluid, 
.main-content,
.content-wrapper {
 
    width: 80% !important;
    margin: 0 !important;
    margin-left:5%;
    padding-left: clamp(10px, 2vw, 20px) !important;
    padding-right: clamp(10px, 2vw, 20px) !important;
}

/* Sidebar margin adjustment based on screen size */
@media (min-width: 769px) {
    .container, 
    .container-fluid, 
    .main-content,
    .content-wrapper {
        margin-left: clamp(200px, 15vw, 240px) !important;
        width: calc(100% - clamp(200px, 15vw, 240px)) !important;
    }
}

body {
    background-color: #f8fafc;
    margin: 0;
    padding: 0;
    font-size: clamp(14px, 1.5vw, 16px);
    line-height: 1.5;
}

/* Welcome Section - Responsive */
.welcome-section {
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    color: white;
    border-radius: clamp(12px, 2vw, 16px);
    padding: clamp(16px, 3vw, 28px);
    margin-bottom: clamp(16px, 3vw, 24px);
    position: relative;
    overflow: hidden;
}

.welcome-content {
    position: relative;
    z-index: 2;
}

.welcome-title {
    font-size: clamp(18px, 4vw, 24px);
    font-weight: 700;
    margin-bottom: 8px;
    line-height: 1.2;
}

.welcome-text {
    font-size: clamp(13px, 2.5vw, 15px);
    opacity: 0.9;
    margin-bottom: 0;
    line-height: 1.4;
}

/* Hide duplicate welcome stats */
.welcome-stats {
    display: none;
}

/* MAIN DASHBOARD CARDS - Enhanced Responsive Grid */
.dashboard-cards {
    display: grid !important;
    grid-template-columns: repeat(auto-fit, minmax(min(280px, 100%), 1fr)) !important;
    gap: clamp(12px, 2vw, 20px) !important;
    margin-bottom: clamp(16px, 3vw, 24px) !important;
    padding: 0 !important;
}

/* Zoom-friendly breakpoints */
@media (max-width: 1600px) and (min-width: 1201px) {
    .dashboard-cards {
        grid-template-columns: repeat(3, 1fr) !important;
    }
}

@media (max-width: 1200px) and (min-width: 901px) {
    .dashboard-cards {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}

@media (max-width: 900px) {
    .dashboard-cards {
        grid-template-columns: 1fr !important;
    }
}

.stat-card {
    background: white;
    border-radius: clamp(8px, 1.5vw, 12px);
    padding: clamp(16px, 3vw, 24px);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: all 0.2s ease;
    position: relative;
    overflow: hidden;
    min-height: clamp(100px, 15vw, 140px);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border-left: 4px solid var(--card-color);
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.stat-card.students { --card-color: #3b82f6; }
.stat-card.classes { --card-color: #10b981; }
.stat-card.assignments { --card-color: #f59e0b; }
.stat-card.attendance { --card-color: #ef4444; }

.stat-card-header {
    display: flex !important;
    justify-content: space-between !important;
    align-items: flex-start !important;
    height: 100%;
    gap: clamp(8px, 2vw, 16px);
}

.stat-card-content {
    flex: 1;
    min-width: 0;
}

.stat-icon {
    width: clamp(36px, 6vw, 48px);
    height: clamp(36px, 6vw, 48px);
    border-radius: clamp(6px, 1vw, 10px);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: clamp(16px, 3vw, 20px);
    color: white;
    flex-shrink: 0;
}

.stat-card.students .stat-icon { background: #3b82f6; }
.stat-card.classes .stat-icon { background: #10b981; }
.stat-card.assignments .stat-icon { background: #f59e0b; }
.stat-card.attendance .stat-icon { background: #ef4444; }

.stat-number {
    font-size: clamp(22px, 5vw, 32px);
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 6px;
    line-height: 1;
}

.stat-label {
    color: #6b7280;
    font-size: clamp(12px, 2vw, 14px);
    font-weight: 500;
    margin-bottom: 8px;
    line-height: 1.2;
}

.stat-change {
    font-size: clamp(10px, 1.5vw, 12px);
    font-weight: 600;
    line-height: 1;
    display: flex;
    align-items: center;
    gap: 4px;
}

.stat-change.positive {
    color: #10b981;
}

.stat-change.negative {
    color: #ef4444;
}

/* QUICK ACTIONS - Enhanced Responsive Grid */
.quick-actions {
    display: grid !important;
    grid-template-columns: repeat(auto-fit, minmax(min(180px, 100%), 1fr)) !important;
    gap: clamp(10px, 2vw, 16px) !important;
    margin-bottom: clamp(16px, 3vw, 24px) !important;
    padding: 0 !important;
}

/* Zoom-friendly quick actions breakpoints */
@media (max-width: 1200px) and (min-width: 769px) {
    .quick-actions {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}

@media (max-width: 768px) {
    .quick-actions {
        grid-template-columns: 1fr !important;
    }
}

.quick-action-btn {
    display: flex;
    align-items: center;
    gap: clamp(8px, 2vw, 12px);
    padding: clamp(12px, 2.5vw, 20px);
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: clamp(6px, 1.5vw, 10px);
    text-decoration: none;
    color: #374151;
    font-weight: 500;
    transition: all 0.2s ease;
    font-size: clamp(12px, 2vw, 14px);
    min-height: clamp(48px, 8vw, 64px);
}

.quick-action-btn:hover {
    border-color: #3b82f6;
    color: #3b82f6;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.15);
    text-decoration: none;
}

.quick-action-icon {
    width: clamp(28px, 5vw, 36px);
    height: clamp(28px, 5vw, 36px);
    border-radius: clamp(4px, 1vw, 8px);
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f3f4f6;
    color: #3b82f6;
    font-size: clamp(12px, 2.5vw, 16px);
    transition: all 0.2s ease;
    flex-shrink: 0;
}

.quick-action-btn:hover .quick-action-icon {
    background: #3b82f6;
    color: white;
}

/* DASHBOARD GRID - Enhanced Responsive */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(min(400px, 100%), 1fr));
    gap: clamp(16px, 3vw, 24px);
    margin-bottom: clamp(16px, 3vw, 24px);
}

/* Zoom-friendly dashboard grid breakpoints */
@media (max-width: 1400px) and (min-width: 901px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 900px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
}

.dashboard-section {
    background: white;
    border-radius: clamp(8px, 1.5vw, 12px);
    padding: clamp(16px, 3vw, 24px);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid #f3f4f6;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: clamp(12px, 2.5vw, 20px);
    padding-bottom: clamp(10px, 2vw, 16px);
    border-bottom: 1px solid #f3f4f6;
    gap: clamp(8px, 2vw, 16px);
}

.section-title {
    font-size: clamp(14px, 2.5vw, 18px);
    font-weight: 600;
    color: #1f2937;
    display: flex;
    align-items: center;
    gap: clamp(6px, 1.5vw, 10px);
    min-width: 0;
    flex: 1;
}

.section-title i {
    color: #3b82f6;
    font-size: clamp(14px, 2.5vw, 18px);
    flex-shrink: 0;
}

.view-all-btn {
    color: #3b82f6;
    text-decoration: none;
    font-size: clamp(11px, 2vw, 14px);
    font-weight: 500;
    transition: color 0.2s ease;
    white-space: nowrap;
    flex-shrink: 0;
}

.view-all-btn:hover {
    color: #2563eb;
    text-decoration: none;
}

/* SCHEDULE SECTION - Enhanced Responsive */
.schedule-item {
    display: flex;
    align-items: center;
    padding: clamp(8px, 2vw, 12px) 0;
    border-bottom: 1px solid #f3f4f6;
    gap: clamp(8px, 2vw, 16px);
}

.schedule-item:last-child {
    border-bottom: none;
}

.schedule-time {
    background: #f8fafc;
    padding: clamp(4px, 1vw, 6px) clamp(8px, 2vw, 12px);
    border-radius: clamp(4px, 1vw, 8px);
    font-weight: 600;
    font-size: clamp(10px, 1.5vw, 12px);
    color: #374151;
    min-width: clamp(50px, 8vw, 65px);
    text-align: center;
    flex-shrink: 0;
}

.schedule-details {
    flex: 1;
    min-width: 0;
}

.schedule-subject {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 4px;
    font-size: clamp(12px, 2vw, 14px);
    line-height: 1.3;
}

.schedule-class {
    font-size: clamp(10px, 1.5vw, 12px);
    color: #6b7280;
    line-height: 1.3;
}

.schedule-status {
    padding: clamp(2px, 0.5vw, 4px) clamp(8px, 2vw, 12px);
    border-radius: clamp(8px, 2vw, 16px);
    font-size: clamp(9px, 1.5vw, 11px);
    font-weight: 600;
    text-transform: uppercase;
    flex-shrink: 0;
    white-space: nowrap;
}

.schedule-status.ongoing {
    background: #dcfce7;
    color: #166534;
}

.schedule-status.upcoming {
    background: #dbeafe;
    color: #1d4ed8;
}

/* ACTIVITIES SECTION - Enhanced Responsive */
.activity-item {
    display: flex;
    align-items: flex-start;
    padding: clamp(8px, 2vw, 12px) 0;
    border-bottom: 1px solid #f3f4f6;
    gap: clamp(8px, 2vw, 12px);
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: clamp(24px, 4vw, 32px);
    height: clamp(24px, 4vw, 32px);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: clamp(10px, 2vw, 14px);
    color: white;
    flex-shrink: 0;
}

.activity-icon.assignment { background: #f59e0b; }
.activity-icon.grade { background: #10b981; }
.activity-icon.attendance { background: #ef4444; }
.activity-icon.message { background: #3b82f6; }

.activity-content {
    flex: 1;
    min-width: 0;
}

.activity-text {
    color: #1f2937;
    font-size: clamp(12px, 2vw, 14px);
    margin-bottom: 4px;
    line-height: 1.4;
}

.activity-time {
    color: #6b7280;
    font-size: clamp(10px, 1.5vw, 12px);
    line-height: 1.3;
}

/* ZOOM RESPONSIVE BREAKPOINTS */
@media (max-width: 1600px) {
    .dashboard-cards {
        gap: clamp(10px, 1.5vw, 18px) !important;
    }
    
    .dashboard-grid {
        gap: clamp(14px, 2.5vw, 22px);
    }
}

@media (max-width: 1400px) {
    .dashboard-cards {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    
    .quick-actions {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}

@media (max-width: 1200px) {
    .dashboard-cards {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 900px) {
    .dashboard-cards {
        grid-template-columns: 1fr !important;
    }
    
    .quick-actions {
        grid-template-columns: 1fr !important;
    }
    
    .stat-card {
        min-height: clamp(90px, 12vw, 120px);
        padding: clamp(14px, 2.5vw, 20px);
    }
    
    .stat-number {
        font-size: clamp(20px, 4vw, 28px);
    }
    
    .stat-icon {
        width: clamp(32px, 5vw, 40px);
        height: clamp(32px, 5vw, 40px);
        font-size: clamp(14px, 2.5vw, 18px);
    }
}

/* MOBILE RESPONSIVE BREAKPOINTS */
@media (max-width: 768px) {
    .container, 
    .container-fluid, 
    .main-content,
    .content-wrapper {
        margin-left: 0 !important;
        width: 100% !important;
        padding-left: clamp(8px, 2vw, 15px) !important;
        padding-right: clamp(8px, 2vw, 15px) !important;
    }
    
    .welcome-section {
        padding: clamp(14px, 3vw, 20px);
        margin-bottom: clamp(12px, 2.5vw, 16px);
    }
    
    .dashboard-section {
        padding: clamp(14px, 3vw, 20px);
    }
    
    .stat-card {
        min-height: clamp(80px, 10vw, 110px);
        padding: clamp(12px, 2.5vw, 18px);
    }
    
    .stat-number {
        font-size: clamp(18px, 3.5vw, 24px);
    }
    
    .schedule-item {
        flex-wrap: wrap;
        gap: clamp(6px, 1.5vw, 12px);
    }
    
    .schedule-status {
        order: 3;
        width: 100%;
        text-align: center;
        margin-top: 8px;
    }
}

@media (max-width: 480px) {
    .container, 
    .container-fluid, 
    .main-content,
    .content-wrapper {
        padding-left: clamp(6px, 1.5vw, 10px) !important;
        padding-right: clamp(6px, 1.5vw, 10px) !important;
    }
    
    .stat-card {
        min-height: clamp(70px, 8vw, 100px);
        padding: clamp(10px, 2vw, 16px);
    }
    
    .stat-number {
        font-size: clamp(16px, 3vw, 22px);
    }
    
    .stat-icon {
        width: clamp(28px, 4vw, 36px);
        height: clamp(28px, 4vw, 36px);
        font-size: clamp(12px, 2vw, 16px);
    }
    
    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: clamp(6px, 1.5vw, 10px);
    }
    
    .view-all-btn {
        align-self: flex-end;
    }
}

/* ULTRA-WIDE SCREENS */
@media (min-width: 1920px) {
    .dashboard-cards {
        grid-template-columns: repeat(4, 1fr) !important;
        max-width: 1800px;
        margin: 0 auto clamp(16px, 3vw, 24px) auto;
    }
    
    .dashboard-grid {
        grid-template-columns: repeat(2, 1fr);
        max-width: 1800px;
        margin: 0 auto clamp(16px, 3vw, 24px) auto;
    }
    
    .quick-actions {
        max-width: 1800px;
        margin: 0 auto clamp(16px, 3vw, 24px) auto;
    }
}

/* HIGH ZOOM LEVELS (Browser zoom > 125%) */
@media (max-width: 1400px) and (min-resolution: 1.25dppx) {
    .dashboard-cards {
        grid-template-columns: 1fr !important;
    }
    
    .quick-actions {
        grid-template-columns: 1fr !important;
    }
    
    .stat-card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    
    .stat-icon {
        align-self: flex-end;
    }
}

/* ANIMATION - Zoom-friendly */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stat-card {
    animation: slideIn 0.4s ease forwards;
}

.stat-card:nth-child(1) { animation-delay: 0s; }
.stat-card:nth-child(2) { animation-delay: 0.1s; }
.stat-card:nth-child(3) { animation-delay: 0.2s; }
.stat-card:nth-child(4) { animation-delay: 0.3s; }

/* REDUCED MOTION PREFERENCES */
@media (prefers-reduced-motion: reduce) {
    .stat-card,
    .quick-action-btn,
    .schedule-item,
    .activity-item {
        animation: none;
        transition: none;
    }
    
    .stat-card:hover,
    .quick-action-btn:hover {
        transform: none;
    }
}

/* HIGH CONTRAST MODE */
@media (prefers-contrast: high) {
    .stat-card,
    .dashboard-section,
    .quick-action-btn {
        border: 2px solid #000;
    }
    
    .stat-change.positive {
        color: #006600;
    }
    
    .stat-change.negative {
        color: #cc0000;
    }
}

/* DARK MODE SUPPORT */
@media (prefers-color-scheme: dark) {
    body {
        background-color: #111827;
    }
    
    .stat-card,
    .dashboard-section,
    .quick-action-btn {
        background: #1f2937;
        border-color: #374151;
        color: #f9fafb;
    }
    
    .stat-number,
    .section-title,
    .activity-text,
    .schedule-subject {
        color: #f9fafb;
    }
    
    .stat-label,
    .activity-time,
    .schedule-class {
        color: #9ca3af;
    }
}

/* UTILITY CLASSES */
.no-scroll {
    overflow: hidden;
}

.scroll-smooth {
    scroll-behavior: smooth;
}

/* FOCUS MANAGEMENT FOR ACCESSIBILITY */
.quick-action-btn:focus,
.view-all-btn:focus {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

/* PRINT STYLES */
@media print {
    .dashboard-cards {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 15px !important;
    }
    
    .stat-card {
        break-inside: avoid;
        height: auto;
        box-shadow: none;
        border: 1px solid #ccc;
    }
    
    .welcome-section {
        background: #f5f5f5 !important;
        color: #000 !important;
    }
    
    .quick-actions {
        display: none !important;
    }
}

/* LOADING STATES */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.8);
    z-index: 10;
}
</style>
@endsection

@section('content')
<!-- Welcome Section -->
<div class="welcome-section">
    <div class="welcome-content">
        <h2 class="welcome-title">Welcome back, {{ Auth::user()->name ?? 'Teacher' }}!</h2>
        <p class="welcome-text">Here's what's happening in your classes today</p>
        <div class="welcome-stats">
            <div class="welcome-stat">
                <span class="welcome-stat-number">5</span>
                <span class="welcome-stat-label">Classes Today</span>
            </div>
            <div class="welcome-stat">
                <span class="welcome-stat-number">127</span>
                <span class="welcome-stat-label">Total Students</span>
            </div>
            <div class="welcome-stat">
                <span class="welcome-stat-number">8</span>
                <span class="welcome-stat-label">Pending Tasks</span>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Cards -->
<div class="dashboard-cards">
    <div class="stat-card students">
        <div class="stat-card-header">
            <div class="stat-card-content">
                <div class="stat-number">127</div>
                <div class="stat-label">Total Students</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> +12 this month
                </div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>
    </div>

    <div class="stat-card classes">
        <div class="stat-card-header">
            <div class="stat-card-content">
                <div class="stat-number">5</div>
                <div class="stat-label">Active Classes</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> +1 this semester
                </div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-school"></i>
            </div>
        </div>
    </div>

    <div class="stat-card assignments">
        <div class="stat-card-header">
            <div class="stat-card-content">
                <div class="stat-number">8</div>
                <div class="stat-label">Pending Assignments</div>
                <div class="stat-change negative">
                    <i class="fas fa-arrow-down"></i> Due this week
                </div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-tasks"></i>
            </div>
        </div>
    </div>

    <div class="stat-card attendance">
        <div class="stat-card-header">
            <div class="stat-card-content">
                <div class="stat-number">94%</div>
                <div class="stat-label">Avg. Attendance</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> +2% this month
                </div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <a href="{{ route('teacher.attendance') }}" class="quick-action-btn">
        <div class="quick-action-icon">
            <i class="fas fa-check"></i>
        </div>
        <span>Take Attendance</span>
    </a>
    <a href="{{ route('teacher.assignments') }}" class="quick-action-btn">
        <div class="quick-action-icon">
            <i class="fas fa-plus"></i>
        </div>
        <span>Create Assignment</span>
    </a>
    <a href="{{ route('teacher.grades') }}" class="quick-action-btn">
        <div class="quick-action-icon">
            <i class="fas fa-chart-bar"></i>
        </div>
        <span>Grade Students</span>
    </a>
    <a href="{{ route('teacher.messages') }}" class="quick-action-btn">
        <div class="quick-action-icon">
            <i class="fas fa-envelope"></i>
        </div>
        <span>Send Message</span>
    </a>
</div>

<!-- Dashboard Grid -->
<div class="dashboard-grid">
    <!-- Today's Schedule -->
    <div class="dashboard-section">
        <div class="section-header">
            <h3 class="section-title">
                <i class="fas fa-calendar-day"></i>
                Today's Schedule
            </h3>
            <a href="{{ route('teacher.timetable') }}" class="view-all-btn">View Full Timetable</a>
        </div>

        <div class="schedule-item">
            <div class="schedule-time">09:00</div>
            <div class="schedule-details">
                <div class="schedule-subject">Mathematics - Algebra</div>
                <div class="schedule-class">Class 10A • Room 201</div>
            </div>
            <div class="schedule-status ongoing">Ongoing</div>
        </div>

        <div class="schedule-item">
            <div class="schedule-time">10:30</div>
            <div class="schedule-details">
                <div class="schedule-subject">Mathematics - Geometry</div>
                <div class="schedule-class">Class 10B • Room 201</div>
            </div>
            <div class="schedule-status upcoming">Upcoming</div>
        </div>

        <div class="schedule-item">
            <div class="schedule-time">13:00</div>
            <div class="schedule-details">
                <div class="schedule-subject">Mathematics - Statistics</div>
                <div class="schedule-class">Class 11A • Room 205</div>
            </div>
            <div class="schedule-status upcoming">Upcoming</div>
        </div>

        <div class="schedule-item">
            <div class="schedule-time">14:30</div>
            <div class="schedule-details">
                <div class="schedule-subject">Mathematics - Calculus</div>
                <div class="schedule-class">Class 12A • Room 201</div>
            </div>
            <div class="schedule-status upcoming">Upcoming</div>
        </div>

        <div class="schedule-item">
            <div class="schedule-time">16:00</div>
            <div class="schedule-details">
                <div class="schedule-subject">Extra Class - Doubt Clearing</div>
                <div class="schedule-class">Class 10A • Room 201</div>
            </div>
            <div class="schedule-status upcoming">Upcoming</div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="dashboard-section">
        <div class="section-header">
            <h3 class="section-title">
                <i class="fas fa-clock"></i>
                Recent Activities
            </h3>
            <a href="#" class="view-all-btn">View All</a>
        </div>

        <div class="activity-item">
            <div class="activity-icon assignment">
                <i class="fas fa-tasks"></i>
            </div>
            <div class="activity-content">
                <div class="activity-text">Created new assignment for Class 10A</div>
                <div class="activity-time">2 hours ago</div>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon grade">
                <i class="fas fa-chart-bar"></i>
            </div>
            <div class="activity-content">
                <div class="activity-text">Graded 25 test papers for Class 11A</div>
                <div class="activity-time">5 hours ago</div>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon attendance">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="activity-content">
                <div class="activity-text">Marked attendance for all classes</div>
                <div class="activity-time">1 day ago</div>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon message">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="activity-content">
                <div class="activity-text">Sent message to Class 12A parents</div>
                <div class="activity-time">2 days ago</div>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon assignment">
                <i class="fas fa-tasks"></i>
            </div>
            <div class="activity-content">
                <div class="activity-text">Reviewed assignment submissions</div>
                <div class="activity-time">3 days ago</div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Dashboard Sections -->
<div class="dashboard-grid">
    <!-- Upcoming Exams -->
    <div class="dashboard-section">
        <div class="section-header">
            <h3 class="section-title">
                <i class="fas fa-clipboard-list"></i>
                Upcoming Exams
            </h3>
            <a href="{{ route('teacher.exams') }}" class="view-all-btn">Manage Exams</a>
        </div>

        <div class="schedule-item">
            <div class="schedule-time">Mon 15</div>
            <div class="schedule-details">
                <div class="schedule-subject">Mid-term Mathematics</div>
                <div class="schedule-class">Class 10A • 2 hours</div>
            </div>
        </div>

        <div class="schedule-item">
            <div class="schedule-time">Wed 17</div>
            <div class="schedule-details">
                <div class="schedule-subject">Weekly Test - Calculus</div>
                <div class="schedule-class">Class 12A • 1 hour</div>
            </div>
        </div>

        <div class="schedule-item">
            <div class="schedule-time">Fri 19</div>
            <div class="schedule-details">
                <div class="schedule-subject">Quiz - Geometry</div>
                <div class="schedule-class">Class 11A • 30 mins</div>
            </div>
        </div>
    </div>

    <!-- Class Performance -->
    <div class="dashboard-section">
        <div class="section-header">
            <h3 class="section-title">
                <i class="fas fa-trophy"></i>
                Class Performance
            </h3>
            <a href="{{ route('teacher.reports') }}" class="view-all-btn">View Reports</a>
        </div>

        <div class="schedule-item">
            <div class="schedule-details">
                <div class="schedule-subject">Class 10A - Mathematics</div>
                <div class="schedule-class">Average Score: 85% • 32 Students</div>
            </div>
            <div class="schedule-status ongoing" style="background: #d4edda; color: #155724;">Excellent</div>
        </div>

        <div class="schedule-item">
            <div class="schedule-details">
                <div class="schedule-subject">Class 11A - Mathematics</div>
                <div class="schedule-class">Average Score: 78% • 28 Students</div>
            </div>
            <div class="schedule-status upcoming" style="background: #fff3cd; color: #856404;">Good</div>
        </div>

        <div class="schedule-item">
            <div class="schedule-details">
                <div class="schedule-subject">Class 12A - Mathematics</div>
                <div class="schedule-class">Average Score: 92% • 30 Students</div>
            </div>
            <div class="schedule-status ongoing" style="background: #d4edda; color: #155724;">Outstanding</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Enhanced responsive dashboard functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-refresh dashboard data every 5 minutes
        setInterval(function() {
            // Add AJAX calls here to refresh specific sections
            console.log('Dashboard data refreshed');
        }, 300000);

        // Add click handlers for quick actions with loading states
        document.querySelectorAll('.quick-action-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                // Add loading state
                this.classList.add('loading');
                console.log('Quick action clicked:', this.textContent.trim());
                
                // Remove loading state after navigation (or on error)
                setTimeout(() => {
                    this.classList.remove('loading');
                }, 1000);
            });
        });

        // Enhanced animation for stat cards with stagger effect
        const statCards = document.querySelectorAll('.stat-card');
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    entry.target.style.animationDelay = `${index * 0.1}s`;
                    entry.target.style.animation = 'slideUp 0.6s ease forwards';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        statCards.forEach(card => {
            observer.observe(card);
        });

        // Responsive navigation helper for mobile
        function handleResponsiveLayout() {
            const viewport = window.innerWidth;
            const body = document.body;
            
            if (viewport <= 768) {
                body.classList.add('mobile-layout');
            } else {
                body.classList.remove('mobile-layout');
            }
            
            // Handle zoom levels
            const zoomLevel = Math.round((window.outerWidth / window.innerWidth) * 100);
            if (zoomLevel > 125) {
                body.classList.add('high-zoom');
            } else {
                body.classList.remove('high-zoom');
            }
        }

        // Initial check and resize listener
        handleResponsiveLayout();
        window.addEventListener('resize', handleResponsiveLayout);

        // Touch gesture support for mobile
        let touchStartX = 0;
        let touchStartY = 0;

        document.addEventListener('touchstart', function(e) {
            touchStartX = e.touches[0].clientX;
            touchStartY = e.touches[0].clientY;
        });

        document.addEventListener('touchmove', function(e) {
            if (!touchStartX || !touchStartY) return;

            const touchEndX = e.touches[0].clientX;
            const touchEndY = e.touches[0].clientY;
            const diffX = touchStartX - touchEndX;
            const diffY = touchStartY - touchEndY;

            // Prevent horizontal scrolling on mobile for better UX
            if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 50) {
                e.preventDefault();
            }
        });

        // Progressive loading for better performance
        const sections = document.querySelectorAll('.dashboard-section');
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('loaded');
                    // Load section-specific data here if needed
                }
            });
        }, { threshold: 0.1 });

        sections.forEach(section => {
            sectionObserver.observe(section);
        });

        // Keyboard navigation support
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                document.body.classList.add('keyboard-navigation');
            }
        });

        document.addEventListener('mousedown', function() {
            document.body.classList.remove('keyboard-navigation');
        });

        // Performance monitoring
        if ('performance' in window) {
            window.addEventListener('load', function() {
                const loadTime = performance.now();
                console.log(`Dashboard loaded in ${loadTime.toFixed(2)}ms`);
            });
        }

        // Error handling for failed resource loads
        window.addEventListener('error', function(e) {
            console.error('Dashboard resource failed to load:', e.target.src || e.target.href);
        });

        // Connection status monitoring
        window.addEventListener('online', function() {
            document.body.classList.remove('offline');
            console.log('Dashboard back online');
        });

        window.addEventListener('offline', function() {
            document.body.classList.add('offline');
            console.log('Dashboard offline');
        });
    });

    // Utility functions for responsive behavior
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Smooth scrolling for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush