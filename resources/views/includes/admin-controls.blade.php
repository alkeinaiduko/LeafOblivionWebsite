<header class="admin-header">
    <div class="text-right">
        <a href="/admin/logout">Logout</a>
    </div>
</header>
<div class="leaf-sidebar">
    <div style="margin-bottom: 40px; display: flex; align-items: center;">
        <img class="logo" src="/images/LO.png" width="50"> <span style="font-size: 1em; font-weight: bold; margin-left: 1em;">LEAF OBLIVION</span>
    </div>
    <div class="profile text-center">
        <h4>{{ Auth::user()->name }}</h4>
        <span>{{ Auth::user()->role->role }}</span>
    </div>
    <hr>
    <ul>
        <li><a href="#"><i class="el-icon-menu"></i> Dashboard</a></li>
        <li><a href="/admin/roles"><i class="el-icon-s-custom"></i> Page Roles</a></li>
        <li><a href="/admin/admins"><i class="el-icon-s-custom"></i> Admins</a></li>
        <li><a href="#"><i class="el-icon-edit-outline"></i> Patch Notes</a></li>
        <li><a href="/admin/car-dealerships"><i class="el-icon-suitcase"></i> Car Dealership</a></li>
    </ul>
</div>
