<nav class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
            <a class="text-muted" href="/">Big Apple Stars Awards</a>
          </div>
          <div class="col-4 text-center">
            <h3 class="blog-header-logo text-dark" href="/">Judge Panel</h3>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
              <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ auth()->user()->name }}
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/logout">logout</a>
                    
                  </div>
                </div>        
            </div>
        </div>
    </nav>