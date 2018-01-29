<span class="hidden-xs">
    <nav class="nav-filter">
        <div class="container">
            <ul class="nav nav-tabs">
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Categories <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($categories as $count => $category)
                            <li class="{{ Request::is('files/category/'.$category->slug) ? 'active' : '' }}">
                                <a href="{{ route('file.categories', $category->slug) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Date <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/files?filter=newest-files">Newest</a>
                        </li>
                        <li>
                            <a href="/files?filter=oldest-files">Oldest</a>
                        </li>
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Price <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/files?filter=price-high">Price High</a>
                        </li>
                        <li>
                            <a href="/files?filter=price-low">Price Low</a>
                        </li>
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Features <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/files?filter=with_videos">Video</a>
                        </li>
                    </ul>
                </li>
                <li role="presentation">
                    <a href="/files?filter=most-sales">Most Sales</a>
                </li>
            </ul>
        </div>
    </nav>
</span>


<div class="visible-xs">
    <div id="FILES-MOBILE-FILTER">
        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#fileFilters" aria-expanded="false" aria-controls="fileFilters">
            Filter
        </a>

        <div class="collapse" id="fileFilters">
            <ul class="nav nav-tabs">
              <li role="presentation" class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      Categories <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                      @foreach($categories as $count => $category)
                          <li class="{{ Request::is('files/category/'.$category->slug) ? 'active' : '' }}">
                              <a href="{{ route('file.categories', $category->slug) }}">{{ $category->name }}</a>
                          </li>
                      @endforeach
                  </ul>
              </li>
              <li role="presentation" class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      Date <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                      <li>
                          <a href="/files?filter=newest-files">Newest</a>
                      </li>
                      <li>
                          <a href="/files?filter=oldest-files">Oldest</a>
                      </li>
                  </ul>
              </li>
              <li role="presentation" class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      Price <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                      <li>
                          <a href="/files?filter=price-high">Price High</a>
                      </li>
                      <li>
                          <a href="/files?filter=price-low">Price Low</a>
                      </li>
                  </ul>
              </li>
              <li role="presentation" class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      Features <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                      <li>
                          <a href="/files?filter=with_videos">Video</a>
                      </li>
                  </ul>
              </li>
              <li role="presentation">
                  <a href="/files?filter=most-sales">Most Sales</a>
              </li>
            </ul>
        </div>
    </div>
</div>