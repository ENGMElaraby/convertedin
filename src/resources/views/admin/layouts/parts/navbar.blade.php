<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-menu">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </a>
        <ul class="navbar-item flex-row navbar-dropdown search-ul">
            <li class="nav-item dropdown language-dropdown more-dropdown">
                <div class="dropdown  custom-dropdown-icon">
                    <a class="d-none shadow-none badge badge-dark m-1" href="#" role="button"
                       id="total_questionTag"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">عدد الاسئلة <span id="total_question"></span>
                    </a>
                    <a class="d-none shadow-none badge badge-dark m-1" href="#" role="button"
                       id="total_sentenceTag"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">عدد القطعه <span id="total_sentence"></span>
                    </a>
                    <a class="d-none shadow-none badge badge-dark m-1" href="#" role="button"
                       id="total_sentence_questionTag"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">عدد اسئله القطعه <span
                                id="total_sentence_question"></span>
                    </a>
                </div>
            </li>

            <li class="nav-item dropdown notification-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-bell">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>

                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
                    <div class="notification-scroll">
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('assets/img/profile-7.jpg') }}" alt="{{ auth()->user()->name }}"
                         class="img-fluid">
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <img src="{{ asset('assets/img/profile-7.jpg') }}" class="img-fluid mr-2" alt="avatar">
                            <div class="media-body">
                                <h5>{{ auth()->user()->name }}</h5>
                                <p>Admin</p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-log-out">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span>Log Out</span>
                        </a>

                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->
