<!-- General JS Scripts -->
<script src="{{ asset('assets/bundles/lib.vendor.bundle.js') }}"></script>
<script src="{{ asset('assets/js/CodiePie.js') }}"></script>

<!-- JS Libraies -->
<script src="{{ asset('assets/modules/dropzonejs/min/dropzone.min.js') }}"></script>

<script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/addons/cleave-phone.us.js') }}"></script>
<script src="{{ asset('assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>



<!-- Page Specific JS File -->
<script src="{{ asset('assets/js/page/auth-register.js') }}"></script>
<script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
<script src="{{ asset('assets/js/page/components-chat-box.js') }}"></script>
<script src="{{ asset('assets/js/page/components-table.js') }}"></script>
<script src="{{ asset('assets/js/page/modules-toastr.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>


<!-- other script -->
<script>
    function confirmation(ev, id) {
        ev.preventDefault();
        var urlToRedirect = document.getElementById('delete-form-' + id).getAttribute('action');
        console.log(urlToRedirect);
        swal({
                title: "Etes-vous sûr de supprimer ceci",
                text: "Vous ne pourrez pas annuler cette suppression",
                icon: "warning",
                buttons: true,
                dangerMode: true
            })
            .then((willCancel) => {
                if (willCancel) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
    }
</script>

<!-- succes message timeout -->
<script>
    // Set a timer to remove the message after 10 seconds
    setTimeout(function() {
        var toastMessage = document.getElementById('toast-message');
        if (toastMessage) {
            toastMessage.remove();
        }
    }, 4000); // 10000 milliseconds = 10 seconds
</script>

<script>
    $(document).ready(function() {
        $("#togglePassword").click(function() {
            var passwordField = $("#new_password");
            var passwordFieldType = passwordField.attr('type');
            if (passwordFieldType == 'password') {
                passwordField.attr('type', 'text');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>

{{-- <script>
    const search_form = document.getElementById("search-form");
    let initialTbodyContent = ''

    function getCurrentRoute(uri) {
        return uri.split('/').shift();
    }

    const tbody = document.getElementById(category + '_tbody');



    document.addEventListener("DOMContentLoaded", () => {
        initialTbodyContent = tbody.innerHTML;
    });

    search_form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const search = e.target["search"].value;

        const category = getCurrentRoute("{{ request()->route()->uri }}");

        let isSubmitting = false;


        if (search !== '') {
            try {
                isSubmitting = true;
                if (isSubmitting) {
                    tbody.innerHTML = `<span class="loader"><span class="loader-inner"></span></span>`;
                }





                const response = await fetch('/search', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        category,
                        search
                    }):
                });

                if (response.ok) {
                    const data = await response.json();
                    tbody.innerHTML = '';

                    for (let currentRow of data.data) {
                        let rowHTML = '<tr>';

                        if (category === 'professeurs' && currentRow['image']) {
                            const imageUrl = `http://localhost:8000/storage/${currentRow['image']}`;
                            rowHTML +=
                                `<td><img src="${imageUrl}" class="img-fluid" 
                                width="50" alt="${currentRow['name']}"></td>`;
                        }

                        for (let key in currentRow) {
                            if (['id', 'created_at', 'updated_at', 'professeur_id', 'groupe_id'].includes(
                                    key)) {
                                continue;
                            }

                            if (category === 'groups' && key === 'professeur') {
                                rowHTML += `<td>${currentRow['professeur'].name}</td>`;
                            } else if (category === 'etudiants' && key === 'groupe') {
                                rowHTML += `<td>${currentRow['groupe'].name}</td>`;
                            } else if (key !== 'image') {
                                rowHTML += `<td>${currentRow[key]}</td>`;
                            }
                        }

                        const editUrl = `/${category}/${currentRow['id']}/edit`;
                        const deleteUrl = `/${category}/${currentRow['id']}`;

                        rowHTML += `
                        <td class="d-flex">
                            <a href="${editUrl}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="${deleteUrl}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    `;

                        rowHTML += '</tr>';
                        tbody.innerHTML += rowHTML;
                    }
                } else {
                    console.error("Error fetching data:", response.statusText);
                }
            } catch (error) {
                console.log(error.message);
            } finally {
                isSubmitting = false;
            }
        } else {
            tbody = initialTbodyContent
        }
    });
</script> --}}


<script>
    const search_form = document.getElementById("search-form");
    let initialTbodyContent = '';

    function getCurrentRoute(uri) {
        return uri.split('/').shift();
    }

    function createSpinner() {
        const spinner = document.createElement('span');
        spinner.className = 'searchSpinner';
        spinner.style.display = 'none';
        return spinner;
    }

    document.addEventListener("DOMContentLoaded", () => {
        const category = getCurrentRoute("{{ request()->route()->uri }}");
        const tbody = document.getElementById(category + '_tbody');
        initialTbodyContent = tbody.innerHTML;

        const spinner = createSpinner();
        tbody.parentElement.appendChild(spinner);
        tbody.spinner = spinner;
    });

    search_form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const search = e.target["search"].value;
        const category = getCurrentRoute("{{ request()->route()->uri }}");
        const tbody = document.getElementById(category + '_tbody');
        const spinner = tbody.spinner;
        console.log(spinner)
        let isSubmitting = false;

        if (search !== '') {
            try {
                isSubmitting = true;
                if (isSubmitting) {
                    spinner.style.display = 'block';
                    tbody.innerHTML = ''

                }
                const response = await fetch('/search', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        category,
                        search
                    })
                });

                if (response.ok) {
                    const data = await response.json();
                    tbody.innerHTML = '';
                    if (data.data.length < 1) {
                        tbody.innerHTML = '<tr><td colspan="6">No results found</td></tr>';
                    } else {
                        for (let currentRow of data.data) {
                            let rowHTML = '<tr>';

                            if (category === 'professeurs' && currentRow['image']) {
                                const imageUrl = `http://localhost:8000/storage/${currentRow['image']}`;
                                rowHTML +=
                                    `<td><img src="${imageUrl}" 
                                    width="50" alt="${currentRow['name']}"></td>`;
                            } else if (category === 'cours' && currentRow['image']) {
                                const imageUrl = `http://localhost:8000/storage/${currentRow['image']}`;
                                rowHTML +=
                                    `<td><img src="${imageUrl}"
                                    width="50" alt="${currentRow['name']}"></td>`;
                            }

                            for (let key in currentRow) {
                                if (['id', 'created_at', 'updated_at', 'professeur_id', 'groupe_id',
                                        'last_login_at'
                                    ]
                                    .includes(
                                        key)) {
                                    continue;
                                }

                                if (category === 'groups' && key === 'professeur') {
                                    rowHTML += `<td>${currentRow['professeur'].name}</td>`;
                                } else if (category === 'etudiants' && key === 'groupe') {
                                    rowHTML += `<td>${currentRow['groupe'].name}</td>`;
                                } else if (category === 'cours' && key === 'professeur') {
                                    rowHTML += `<td>${currentRow['professeur'].name}</td>`;
                                } else if (key !== 'image') {
                                    rowHTML += `<td>${currentRow[key]}</td>`;
                                }
                            }

                            const editUrl = `/${category}/${currentRow['id']}/edit`;
                            const deleteUrl = `/${category}/${currentRow['id']}`;

                            rowHTML += `
                                <td>
                                    <a href="${editUrl}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="${deleteUrl}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');" style="display:inline;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            `;

                            rowHTML += '</tr>';
                            tbody.innerHTML += rowHTML;
                        }
                    }
                } else {
                    console.error("Error fetching data:", response.statusText);
                }
            } catch (error) {
                console.log(error.message);
            } finally {
                isSubmitting = false;
                spinner.style.display = 'none';
            }
        } else {
            tbody.innerHTML = initialTbodyContent;
        }
    });
</script>
