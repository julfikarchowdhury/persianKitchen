<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">

    <div class="sidebar-brand d-none d-md-flex">
        <div class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <h2 class="font-weight-bolder text-center py-2 text-white">Persian Kitchen</h2>
        </div>
        <div class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <h2 class="font-weight-bolder text-center py-2 text-white">P K</h2>
        </div>
    </div>
    <ul class="sidebar-nav ms-2" data-coreui="navigation">
        <li class="nav-item">
            <a class="nav-link" href="{{url('admin/dashboard')}}">
                <i class="fa-solid fa-table-columns"></i>
                <span class="ms-4 menu-title">Dashboard</span>
            </a>
        </li>


        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <i class="fa-solid fa-folder-tree"></i>
                <span class="ms-4 menu-title">Category</span>
            </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{url('admin/category')}}"><i class="fa-solid fa-border-all"></i>
                        <span class="ms-4 menu-title">All Category</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('admin/add-category')}}"><i class="fa-solid fa-plus"></i>
                        <span class="ms-4 menu-title">Add Category</span></a></li>
            </ul>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <i class="fa-solid fa-folder-tree"></i>
                <span class="ms-4 menu-title">Recipe</span>
            </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{url('admin/recipe')}}"><i class="fa-solid fa-border-all"></i>
                        <span class="ms-4 menu-title">All Recipe</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('admin/add-recipe')}}"><i class="fa-solid fa-plus"></i>
                        <span class="ms-4 menu-title">Add Recipe</span></a></li>
            </ul>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>