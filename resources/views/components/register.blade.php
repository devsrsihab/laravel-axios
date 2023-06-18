<!-- component -->

<div class="font-mono bg-gray-400">
    <!-- Container -->
    <div class="container mx-auto">
        <div class="flex justify-center px-6 my-12">
            <!-- Row -->
            <div class="w-full xl:w-3/4 lg:w-11/12 flex">
                <!-- Col -->
                <div class="w-full h-auto bg-gray-400 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg"
                    style="background-image: url('https://source.unsplash.com/Mv9hjnEUHR4/600x800')"></div>
                <!-- Col -->
                <div class="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none">
                    <h3 class="pt-4 text-2xl text-center">Create an Account!</h3>
                    <form id="studentStoreForm" class="px-8 pt-6 pb-8 mb-4 bg-white rounded" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="mb-4 ">
                            <div class="md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                                    Full Name
                                </label>
                                <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="name" type="text" placeholder="Full Name" />
                                    <p id="name-error" class="st-error hidden text-xs italic text-red-500"></p>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                Email
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="email" type="email" placeholder="Email" />
                                <p id="email-error" class="st-error hidden text-xs italic text-red-500"></p>
                        </div>
                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                    Password
                                </label>
                                <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="password" type="text" placeholder="Enter Password" />
                            <p id="password-error" class="st-error hidden text-xs italic text-red-500"></p>
                            </div>
                            <div class="md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="password_confirmation">
                                    Confirm Password
                                </label>
                                <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="password_confirmation" type="text" placeholder="Enter re-type Password" />
                                <p id="paswordConfirm-error" class="st-error hidden text-xs italic text-red-500"></p>
                            </div>
                        </div>
                        <div class="mb-6 text-center">
                            <button
                                class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                type="submit">
                                Register Account
                            </button>
                        </div>
                        <hr class="mb-6 border-t" />
                        <div class="text-center">
                            <a class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800" href="#">
                                Forgot Password?
                            </a>
                        </div>
                        <div class="text-center">
                            <a class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                href="./index.html">
                                Already have an account? Login!
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- js --}}
@push('scripts')
<script>
    $(document).ready(function () {
        

        // Store data 
        $(document).on('submit','#studentStoreForm', function (e) {
          e.preventDefault();

          const name      = document.getElementById('name').value;;
          const email     = document.getElementById('email').value;
          const password  = document.getElementById('password').value;
          const confirm_password       = document.getElementById('password_confirmation').value;



          axios.post("{{ route('registerAction') }}",{
            //data passing

            name    : name,
            email   : email,
            password: password,
            password_confirmation : password_confirmation,

            
          })
          .then(function(response){
            console.log(response);
            $('.st-error').html('');
            $('.st-error').addClass('hidden');
            // $('.table_grand_parent').load(location.href + ' .table_grand_parent');
            // $('.branch_data_count').load(location.href + ' .branch_data_count');



          })// try end
          .catch(function (error) {
            
            console.log(error);
            $('.st-error').html('');
            $('.st-error').removeClass('hidden');

            const errorFields = [
          {input:'#name', field: '#name-error', element: 'name' },
          {input:'#email', field: '#email-error', element: 'email' },
          {input:'#password', field: '#password-error', element: 'password' },
          {input:'#password_confirmation', field: '#paswordConfirm-error', element: 'password_confirmation' },

        ];

        let hasErrors = false;

        for (const {input, field, element} of errorFields) {

            const anyError = error.response.data.errors[element] && error.response.data.errors[element][0];


            if (anyError)
            {
                hasErrors = true;
                $(input).addClass('border-red-500');
                $(field).text(error.response.data.errors[element][0]);                
            }
            else
            {
                $(input).removeClass('border-red-500');
                $(field).text('');   
            }

        }







          })// catch end
          
        });
    });
</script>
    
@endpush
