<!-- NAVIGATION -->
<header>
    <div class="header js-header js-dropdown">
        <div class="container">
            <div class="header__logo">
                <a class="header__link" href="index.html" title="Bluumhealth">
                    <h1>
                        <img src="{{ asset('images/logo_small.png') }}" alt="logo" />
                    </h1>
                    <div class="header__logo-btn">Bluumhealth</div>
                </a>
            </div>
            <div class="header__search">
                <form action="#">
                    <label>
                        <i class="icon-Search js-header-search-btn-open"></i>
                        <input type="search" placeholder="Search anything" class="form-control" />
                    </label>
                </form>
                <div class="header__search-close js-header-search-btn-close"><i class="icon-Cancel"></i></div>
            </div>
            <div class="header__menu">
                <a class="header__menu__link" href="/questions">Ask</a>
            </div>
            <div class="header__menu">
                <a class="header__menu__link" href="/blog">Blog</a>
            </div>
            <div class="header__menu">
                <a class="header__menu__link" href="/login">Sign In</a>
            </div>
            <div class="header__menu">
                <a class="header__menu__link" href="/register">Sign Up</a>
            </div>
            <div class="header__menu header__dropdown">
                <div class="header__menu-btn" data-dropdown-btn="menu">
                    Questions <i class="icon-Menu_Icon"></i>
                </div>
                <nav class="dropdown dropdown--design-01" data-dropdown-list="menu">
                    <div>
                        <ul class="dropdown__catalog row">
                            <li class="col-xs-6"><a href="questions.html">New</a></li>
                            <li class="col-xs-6"><a href="questions.html">Experts</a></li>
                            <li class="col-xs-6"><a href="questions.html">Tags</a></li>
                            <li class="col-xs-6"><a href="questions.html">Pregnancy</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3>Categories</h3>
                        <ul class="dropdown__catalog row">
                            <li class="col-xs-6"><a href="#" class="category"><i class="bg-5dd39e"></i>Random</a></li>
                            <li class="col-xs-6"><a href="#" class="category"><i class="bg-c49bbb"></i>Science</a></li>
                            <li class="col-xs-6"><a href="#" class="category"><i class="bg-525252"></i>Education</a></li>
                            <li class="col-xs-6"><a href="#" class="category"><i class="bg-777da7"></i>Q&amp;As</a></li>
                            <li class="col-xs-6"><a href="#" class="category"><i class="bg-368f8b"></i>Politics</a></li>
                        </ul>
                    </div>
                    <div>
                        <ul class="dropdown__catalog row">
                            <li class="col-xs-6"><a href="#">Forum Rules</a></li>
                            <li class="col-xs-6"><a href="#">Blog</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="header__user">
                <div class="header__user-btn" data-dropdown-btn="user">
                    <img src="{{ asset('fonts/icons/avatars/N.svg') }}" alt="avatar">
                    Nelson Ife<i class="icon-Arrow_Below"></i>
                </div>
                <nav class="dropdown dropdown--design-01" data-dropdown-list="user">
                    <div>
                        <div class="dropdown__icons">
                            <a href="#"><i class="icon-Bookmark"></i></a>
                            <a href="#"><i class="icon-Message"></i></a>
                            <a href="#"><i class="icon-Preferences"></i></a>
                            <a href="#"><i class="icon-Logout"></i></a>
                        </div>
                    </div>
                    <div>
                        <ul class="dropdown__catalog">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Badges</a></li>
                            <li><a href="#">My Groups</a></li>
                            <li><a href="#">Notifications</a></li>
                            <li><a href="#">Topics</a></li>
                            <li><a href="#">Likes</a></li>
                            <li><a href="#">Solved</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="header__offset-btn">
            <a href="create-post.html"><img src="{{asset('fonts/icons/main/New_Topic.svg')}}" alt="New Blog Post"></a>
        </div>
    </div>
</header>
