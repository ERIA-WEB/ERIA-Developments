<div class="container-fluid searchbar bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 my-md-4 my-xs-3">
                <form action="../html/search-result.html" class="form-inline">
                    <input class="form-control mr-sm-2 searchbar-input" type="submit" placeholder="Search" aria-label="Search">
                    <button class="btn my-2 my-sm-0 text-light text-center px-4" id="show" type="submit">Go<span class="fa fa-angle-right pl-3"></span></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Experts section -->
<div class="container publication-detail-page mb-5 pr-md-5 pr-1 section-top">
    <div class="row">
        <div class="col-md-4 col-12">

            <div class="profile-overView ">
                <span class="publication-type-tittle mb-3">Publication Type</span>

                <div>All</div>
                <div class="selected pt-3">Annual Reports</div>
                <div>Books</div>
                <div>Co-Publications</div>
                <div>Co-Publications:Routledge</div>
                <div>Co-Publications:Springer</div>
                <div>Disucussion Papers</div>
                <div>East Asia Updates</div>
                <div>Newsletters</div>
                <div>Publication Catalogues</div>
                <div>Reasearch Project Reports</div>
                <div>Summary of ERIA Research Projects</div>
            </div>
            <div class="container mt-5 pt-2 subscribe">
                <div class="row py-3 pb-4 section-divider">
                    <div class="col-md-12 col-xs-12">
                        <div class="heading">Subscribe to Mailing List</div>
                        <div class="description">Invitations . Publications . Newsletters</div>
                        <div class="py-3">
                            <input type="text" class="form-control" placeholder="Enter your email address">
                        </div>
                        <button class="btn btn-subscribe mt-1 py-2" data-toggle="modal" data-target="#subscribeModal">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- right section -->
        <div class="col-md-8 col-12 publication-browse-page">
            <div class="publication-browse-tittle mb-3">
                Annual Reports
            </div>
            <form>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="p-1 rounded my-md-0 my-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button id="button-addon2" type="submit" class="btn btn-link text-secondary border border-right-0">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                                <input type="search" placeholder="Search Keyword" aria-describedby="button-addon2" class="form-control border-left-0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-md-4 mb-0">
                    <div class="col-md-6 col-xs-12 mb-md-0 mb-2">
                        <div class="dropdown">
                            <button class="btn bg-white border  w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Author<i class="fa fa-angle-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12 mb-md-0 mb-2">
                        <div class="dropdown">
                            <button class="btn bg-white border  w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Publication type<i class="fa fa-angle-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12 mb-md-0 mb-2">
                        <div class="dropdown">
                            <button class="btn bg-white border  w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Region<i class="fa fa-angle-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12 mb-md-0 mb-4">
                        <button class="btn text-light w-100 drop-btn" type="button">
                            Search
                        </button>
                    </div>
                </div>

            </form>
            <!-- drop sort -->

            <div class="row mt-4">
                <div class="col-md-6 col-xs-12 mb-md-0 mb-2 sort-section">
                    <div class="sorrt-tittle">
                        Sort by
                    </div>
                    <div class="dropdown" style=" width: 264px;">
                        <button class="btn bg-white border  w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Relevance<i class="fa fa-angle-down"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-xs-12  sort-section">

                </div>
                <div class="col-md-3 col-xs-12 sort-section">
                    <div class="sorrt-tittle">
                        View by
                    </div>
                    <div class="dropdown" style=" width: 80px;">
                        <button class="btn bg-white border  w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            60<i class="fa fa-angle-down"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">1</a>
                            <a class="dropdown-item" href="#">2</a>
                            <a class="dropdown-item" href="#">3</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- topics -->
            <div class="search-section pt-3">
                <div class="Publication-tittle-subtittle ">Capacity Building, COVID-19, Trade
                </div>
                <div class="Publication-tittle-bc ">Energy Efficiency and Conservation Master Plan of Cambodia
                </div>
                <div class="date pb-4">12 August 2020</div>
                <p class="pubdescde">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim justo. Vestibulum </p>


            </div>
            <hr>
            <div class="search-section pt-3">
                <div class="Publication-tittle-subtittle ">E-commerce, Digital Economy, ASEAN, Innovation and Technology
                </div>
                <div class="Publication-tittle-bc ">Improving Digital Connectivity: Policy Priority for ASEAN Digital
                </div>
                <div class="date pb-4">12 August 2020</div>
                <p class="pubdescde">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim justo. Vestibulum </p>

            </div>
            <hr>
            <div class="search-section pt-3">
                <div class="Publication-tittle-subtittle ">Agriculture, Food Value Chain, disaster risk management, Production Networks
                </div>
                <div class="Publication-tittle-bc ">Vulnerability of Agriculture Production Networks and Global Food Value Chains Due to Natural Disaster
                </div>
                <div class="date pb-4">12 August 2020</div>
                <p class="pubdescde">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim justo. Vestibulum
                </p>


            </div>
            <hr>
            <div class="search-section pt-3">
                <div class="Publication-tittle-subtittle ">Sustainable Development Goals
                </div>
                <div class="Publication-tittle-bc ">Project 2045 Executive Summary Indonesia - Japan 2045 : A Joint Project of Two Maritime Democracies
                </div>
                <div class="date pb-4">12 August 2020</div>
                <p class="pubdescde">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim justo. Vestibulum
                </p>


            </div>



            <nav aria-label="Page navigation example ">
                <ul class="pagination pt-3">

                    <li class="page-item pr-4"><a class="page-link" href="#">First</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span class="arrow" aria-hidden="true">
                                ◂</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span class="arrow" aria-hidden="true">▸</span>
                        </a>
                    </li>
                    <li class="page-item pl-4"><a class="page-link" href="#">Last</a></li>

                </ul>
            </nav>

        </div>


    </div>

</div>