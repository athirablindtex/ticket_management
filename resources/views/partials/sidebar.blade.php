    <!-- partial:partials/_sidebar.html -->
    <aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
      <div class="mdc-drawer__header">
        <a href="index.html" class="brand-logo">
        <div style="display: flex; align-items: center;">
    <svg 
        xmlns="http://www.w3.org/2000/svg" 
        viewBox="0 0 64 64" 
        width="80" 
        height="80" 
        fill="none">
        <circle 
            cx="32" 
            cy="32" 
            r="30" 
            stroke="#9B1FE8" 
            stroke-width="4" 
            fill="white"/>
        <path 
            d="M32 16V32L44 36" 
            stroke="#9B1FE8" 
            stroke-width="4" 
            stroke-linecap="round" 
            stroke-linejoin="round"/>
        <circle 
            cx="32" 
            cy="32" 
            r="3" 
            fill="#9B1FE8"/>
        <path 
            d="M32 2C15.34 2 2 15.34 2 32c0 16.66 13.34 30 30 30s30-13.34 30-30C62 15.34 48.66 2 32 2zm0 58c-15.75 0-28.5-12.75-28.5-28.5S16.25 3 32 3 60.5 15.75 60.5 32 47.75 60 32 60z" 
            fill="#9B1FE8" 
            opacity="0.1"/>
    </svg>
    <h1 style="margin-left: 10px; color: #fff; font-family: 'Reem Kufi Fun', sans-serif; font-size: 18px;font-weight:bold">Task Ticketing Platform</h1>
</div>








        </a>
      </div>
      <div class="mdc-drawer__content">
        <div class="user-info">
          <p class="name">Clyde Miles</p>
          <p class="email">clydemiles@elenor.us</p>
        </div>
        <div class="mdc-list-group">
          <nav class="mdc-list mdc-drawer-menu">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="index.html">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
                Dashboardaa
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="pages/forms/basic-forms.html">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">track_changes</i>
                Forms
              </a>
            </div>
              <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui-sub-menu">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">dashboard</i>
                Roles
                <i class="mdc-drawer-arrow material-icons">chevron_right</i>
              </a>
              <div class="mdc-expansion-panel" id="ui-sub-menu" style="display: none;"> <!-- Start hidden -->
                <nav class="mdc-list mdc-drawer-submenu">
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('roles.index') }}">
                      List
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('roles.create') }}">
                      Create
                    </a>
                  </div>
                </nav>
              </div>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui-sub-menu1">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">dashboard</i>
              Users
                <i class="mdc-drawer-arrow material-icons">chevron_right</i>
              </a>
              <div class="mdc-expansion-panel" id="ui-sub-menu1" style="display: none;"> <!-- Start hidden -->
                <nav class="mdc-list mdc-drawer-submenu">
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('users.index') }}">
                      List
                    </a>
                  </div>
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{ route('users.create') }}">
                      Create
                    </a>
                  </div>
                </nav>
              </div>
            </div>

                        
   
   
      
          </nav>
        </div>
        <div class="profile-actions">
          <a href="javascript:;">Settings</a>
          <span class="divider"></span>
          <a href="{{ route('logout') }}">Logout</a>
        </div>
  
      </div>
    </aside>
    <!-- partial -->