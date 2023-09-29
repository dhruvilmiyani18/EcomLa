<!-- sidebar menu -->

@push('select2')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu ">
    <div class="menu_section">
        <ul class="nav side-menu" style="padding-top: 50px;">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i>Dashboard </a></li>

            <div style="text-align:center;"> 
              <select id="select_dropdown" class="select_dropdown" style=" width: 90%;"  class="" name="state" onchange="handleSelectChange(this)">
                <option value="">---select---</option>
                  <optgroup label="Categories">
                      <option value="categories">Categories Manager</option>
                  </optgroup>
                  <optgroup label="Product">
                    <option value="product">Product Manager</option>
                </optgroup>
                
                  <optgroup label="User">
                    <option value="user">View User</option>
                    <option value="user_msg">View User Message</option>
                </optgroup>
                <optgroup label="Oder">
                  <option value="oder">Oder Details</option>
              </optgroup>
              </select>
          </div>

        </ul>
    </div>
</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('admin.logout') }}">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
</div>
</div>


@push('select2_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.select_dropdown').select2();
</script>
<script>
   function handleSelectChange(select) {
        const selectedValue = select.value;
        if (selectedValue === "categories") {
            window.location.href = "{{route('add.category')}}";
        }
        else if (selectedValue === "product") {
          window.location.href = "{{ route('add.product') }}";
        }
        else if (selectedValue === "user") {
          window.location.href = "{{ route('show.user') }}";
        }
        else if (selectedValue === "user_msg") {
          window.location.href = "{{ route('show.user.message') }}";
        }
        else if (selectedValue === "oder") {
          window.location.href = "{{ route('show.oder') }}";
        }
    }
</script>

    
@endpush