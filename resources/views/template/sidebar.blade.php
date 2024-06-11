<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard-sentimentra') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
        {{-- analysis --}}
      </li>
      @if (!Auth::check())

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Analysis</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ url('/singleanalysis') }}">
              <i class="bi bi-circle"></i><span>Single Analysis</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/batch-analysis') }}">
              <i class="bi bi-circle"></i><span>Batch Analysis</span>
            </a>
          </li>
        </ul>
      </li>
      @endif

      {{-- analysis history --}}
      @if (Auth::check())
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/historyanalysis') }}">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>History Analysis</span>
        </a>
      </li><!-- End Tables Nav -->
      @endif

    @if (!Auth::check())
    <li class="nav-item">
       <a class="nav-link" href="{{ url('/wordcloudviews') }}">
          <i class="bi bi-file-word"></i>
          <span>Word Cloud</span>
      </a>
    </li><!-- End Tables Nav -->
    @endif

       {{-- data master --}}
    </li>
    @if (Auth::check())
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#master-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-bar-chart"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="master-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ url('/admin/testdata') }}">
            <i class="bi bi-circle"></i><span>Test Data</span>
          </a>
        </li>
        <li>
          <a href="{{ url('/admin/traindata') }}">
            <i class="bi bi-circle"></i><span>Train Data</span>
          </a>
        </li>
      </ul>
    </li>

    {{-- profil --}}
    <li class="nav-item">
        <a class="nav-link " href="{{ url('/profil') }}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>

      <!-- End Dashboard Nav -->
    </ul>
    @endif

  </aside>
