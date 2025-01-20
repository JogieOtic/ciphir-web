<div class="flex flex-row w-fit gap-6">
    <div class="flex flex-col gap-6 w-full min-w-[460px] max-w-[540px]">
        <div class="bg-[#DDE8F0] w-full p-4 h-fit flex flex-col gap-3 rounded shadow-md">
            <div class="flex flew w-full h-fit gap-4">
                <button type="button" data-modal-target="add-issue-modal" data-modal-toggle="add-issue-modal" class="text-[#2D4373] hover:text-white border border-[#2D4373] hover:bg-[#2D4373] focus:ring-4 focus:outline-none focus:ring-[#2D4373] font-medium rounded-lg text-sm  py-2.5 text-center mb-2 w-full">Add Issue <i class="fa fa-plus pl-2"></i></button>
                <button type="button" data-modal-target="add-infrastructure-modal" data-modal-toggle="add-infrastructure-modal" class="text-[#2D4373] hover:text-white border border-[#2D4373] hover:bg-[#2D4373] focus:ring-4 focus:outline-none focus:ring-[#2D4373] font-medium rounded-lg text-sm py-2.5 text-center mb-2 w-full">Add Infrastructure <i class="fa fa-plus pl-2"></i></button>
            </div>
            <button type="button" data-modal-target="add-administrator-modal" data-modal-toggle="add-administrator-modal" class="text-[#2D4373] hover:text-white border border-[#2D4373] hover:bg-[#2D4373] focus:ring-4 focus:outline-none focus:ring-[#2D4373] font-medium rounded-lg text-sm py-2.5 text-center mb-2 w-full">Add Administrator <i class="fa fa-plus pl-2"></i>
            </button>
        </div>
        <div class="bg-[#DDE8F0] w-full p-4 h-fit flex flex-col gap-3 rounded shadow-md">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Entities / Table
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Size
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                Administrators
                            </th>
                            <td class="px-6 py-4">
                                {{$dataCounts['admin_count']}}
                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                Residents
                            </th>
                            <td class="px-6 py-4">
                                {{$dataCounts['user_count']}}
                            </td>

                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                Reports
                            </th>
                            <td class="px-6 py-4">
                                {{$dataCounts['report_count']}}
                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                Issues
                            </th>
                            <td class="px-6 py-4">
                                {{$dataCounts['issue_count']}}
                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                Infrastructures
                            </th>
                            <td class="px-6 py-4">
                                {{$dataCounts['infrastructure_count']}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Issue modal -->
<div id="add-issue-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                <h3 class="text-xl font-semibold text-gray-900">
                    Add New Issue
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="add-issue-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="{{ route('addNewIssue')}}" method="POST">
                  @csrf
                  @method('POST')
                    <div>
                        <label for="infrastructure_id" class="block mb-2 text-sm font-medium text-gray-900">Choose Infrastructure</label>
                        <select type="text" name="infrastructure_id" id="infrastructure_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <option disabled selected value="">roads, parks, etc.</option>
                            @foreach ($dataEntity['infrastructures'] as $infrastructure)
                                <option value="{{ $infrastructure->infrastructure_id }}">{{ $infrastructure->infrastructure_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="issue" class="block mb-2 text-sm font-medium text-gray-900 ">Issue Title</label>
                        <input type="text" name="issue" id="issue" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="pothole, flooding, etc." required />
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Insert Row</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Infrastructures modal -->
<div id="add-infrastructure-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow ">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
              <h3 class="text-xl font-semibold text-gray-900 ">
                  Add New Infrastructure
              </h3>
              <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="add-infrastructure-modal">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Close modal</span>
              </button>
          </div>
          <!-- Modal body -->
          <div class="p-4 md:p-5">
              <form class="space-y-4" action="{{ route('addNewInfrastructure')}}" method="POST">
                @csrf
                @method('POST')
                  <div>
                      <label for="infrastructure_type" class="block mb-2 text-sm font-medium text-gray-900 ">Infrastructure Type</label>
                      <input type="text" name="infrastructure_type" id="infrastructure_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="roads, parks, etc." required />
                  </div>
                  <div class="flex justify-between gap-4">
                      <div class="flex flex-row w-full justify-between items-center">
                        <label for="password" class="flex mb-2 text-sm font-medium text-gray-900 ">Color Code <span class="italic"> (hex)</span></label>
                        <input type="color" id="color_hex" name="color_hex" value="#f53343" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-12 h-full p-1.5" required>
                      </div>

                      <input type="text" id="hexValue" value="#f53343" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                  </div>
                  <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Insert Row for Infrastructure</button>
              </form>
          </div>
      </div>
  </div>
</div>

<!-- Admin modal -->
<div id="add-administrator-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow ">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
              <h3 class="text-xl font-semibold text-gray-900 ">
                  Add New Administrator
              </h3>
              <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="add-administrator-modal">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Close modal</span>
              </button>
          </div>
          <!-- Modal body -->
          <div class="p-4 md:p-5">
              <form class="space-y-4" action="{{ route('sa.addNewAdmin') }}" method="POST">
                @csrf
                @method('POST')
                    <input type="text" name="role" value="A" required hidden>
                  <div>
                      <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                      <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="juandelacruz" required />
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Create Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                  </div>
                  <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div>
                  <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Insert Administrator</button>
              </form>
          </div>
      </div>
  </div>
</div>
<script>
    const colorPicker = document.getElementById("color_hex");
    const hexValue = document.getElementById("hexValue");

    // Update hexValue when color picker changes
    colorPicker.addEventListener("input", () => {
        hexValue.value = colorPicker.value;
    });

    // Update color picker when hexValue changes
    hexValue.addEventListener("input", () => {
        const hex = hexValue.value.trim();

        // Validate the hex code format (e.g., #FFFFFF)
        if (/^#[0-9A-Fa-f]{6}$/.test(hex)) {
            colorPicker.value = hex;
        }
    });
</script>
