<style>
    .select2-selection__rendered .select2-selection__choice{
      font-size: 17px !important;
    }
    </style>
    
    {{-- include alert msg --}}
        @include('app.shared.alert-msg')
        {{-- include alert msg --}}
    
        {{-- create user start --}}
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
             
              @include('app.shared.agtaskchildform') 
    
                
            </div>
        </div>   
       {{-- create user end --}}

       
     