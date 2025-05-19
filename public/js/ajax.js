function loadpage(url) {
    //console.log(url);
    $('#pages').remove();

    $('#searchedCars').html(`Loading...`);

    $.ajax({
        url: url,
        type: 'GET',
        success: function (data) {
            
            $('#searchedCars').empty();
            //console.log(data);
            const cars = data['data']; 

            $.each(cars, function (index , item) {
                $('#searchedCars').append(`
                        <div class="car-item card">
                            <a href="${'#'}">
                            <img
                                src="${ item.primary_image.image_path }"
                                alt=""
                                class="car-item-img rounded-t"
                            />
                            </a>
                            <div class="p-medium">
                            <div class="flex items-center justify-between">
                                <small class="m-0 text-muted">${ item.city.name }</small>
                                <button class="btn-heart ${''}">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        style="width: 20px"
        
                                    >
                                        <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                                        />
                                    </svg>
    
                                </button>
                            </div>
                            <h2 class="car-item-title">${ item.year } - ${ item.maker.name } ${ item.model.name }</h2>
                            <p class="car-item-price">₹${ item.price }</p>
                            <hr />
                            <p class="m-0">
                                <span class="car-item-badge">${ item.car_type.name }</span>
                                <span class="car-item-badge">${ item.fuel_type.name }</span>
                            </p>
                            </div>
                        </div>
                    `);
            });

            if(data['last_page'] > 1){
                current_page = data['current_page']
                first_page = data['first_page'] 
                last_page = data['last_page'] 
                total = data['total'] 
                first_page_url = data['first_page_url'] 
                last_page_url = data['last_page_url'] 
                page_links = data['links'] 
                nextPageUrl = data['next_page_url'] 
                previousPageUrl = data['prev_page_url'] 
                
                let paginationItems = ``;
                for(let i = 1; i < page_links.length-1; i++){
                    if(page_links[i]['active']){
                        paginationItems += `<span class="pagination-item active"> ${i} </span>`
                    } else {
                        paginationItems += `<button type='button' onClick="loadpage('${page_links[i]['url']}')" class="pagination-item pageBtn"> ${i} </button type='button'>`
                    }
                } 

                $('#searchedCars').after(`

                        <nav class="pagination my-large" id="pages">
                            ${current_page == 1 ?
                                `<span class="pagination-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" style="width: 18px">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                    </svg>
                                </span>`
                            :
                                `<button type='button' onClick="loadpage('${previousPageUrl}')" class="pagination-item pageBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" style="width: 18px">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                    </svg>
                                </button type='button'>`
                            }

                            ${paginationItems}

                            ${current_page >= last_page ? `
                                <span class="pagination-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" style="width: 18px">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>
                                </span>
                                ` : `
                                <button type='button' onClick="loadpage('${nextPageUrl}')" class="pagination-item pageBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" style="width: 18px">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>
                                </button type='button'>
                                `}
                            
                        </nav>

                `)
            }
        
        },
        error: function (error) {
            console.log('Ajax arror : ', error);
        }
    });
}

function watchlist(isInWatchlist=false , isAuthenticated , userID , carID){
    if (! isAuthenticated){
        alert('Login In first.')
        return ;
    }

    if (isInWatchlist){
        let formData = {
            userID : userID,
            carID : carID,
        }
        console.log(formData);
        $.ajax({
            url : '/car/watchlist/remove',
            type : 'POST',
            data : formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(data) {
                console.log(data);
                $(`#WLItem${carID}`).hide();
                $(".pagination-summary").hide();
            
                $(`#${carID} svg`).remove();
                if ($(`#${carID}`).hasClass('text-primary')){
                    $(`#${carID}`).removeClass('text-primary')
                }
                $(`#${carID}`).append(`
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            style="width: 20px"
                        >
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                            />
                        </svg>
                    `);

            },
            error : function(error){
                console.log('Error while deleting : ',error)
            }
        });
    } else {
        let formData = {
            userID : userID,
            carID : carID,
        }
        console.log(formData);
        $.ajax({
            url : '/car/watchlist/add',
            type : 'POST',
            data : formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(data) {
                console.log(data);
                $(`#${carID} svg`).remove();
                if (! $(`#${carID}`).hasClass('text-primary')){
                      $(`#${carID}`).addClass('text-primary')
                }
                $(`#${carID}`).append(`
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            style="width: 16px"
                        >
                            <path
                                d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z"
                            />
                        </svg>
                    `);
            },
            error : function(error){
                console.log('Error while deleting : ',error)
            }
        });
    }

}

$(document).ready(() => {
    let current_page = 1;
    let first_page = 1;
    let last_page = 1;
    let total = 0;
    let first_page_url = '';
    let last_page_url = '';
    let page_links = [];
    let nextPageUrl = '';
    let previousPageUrl = '';

    $('#searchBtn').on('click', function () {

        $('#pages').remove();
        $('#searchedCars').html(`Loading...`);

        const formData = $('#searchForm').serialize();
        $.ajax({
            url: '/car-ajax/search?'+formData,
            type: 'GET',
            success: function (data) {
                total = data['total'];

                $('strong#totalCars').html(total);

                $('#searchedCars').empty();
                //console.log(data);
                const cars = data['data']; 

                $.each(cars, function (index , item) {
                    let car_image = item.id > 102 ? `/storage/${ item.primary_image.image_path }`:item.primary_image.image_path
                    $('#searchedCars').append(`
                            <div class="car-item card">
                                <a href="/car/${item.id}">
                                <img
                                    src="${ car_image }"
                                    alt=""
                                    class="car-item-img rounded-t"
                                />
                                </a>
                                <div class="p-medium">
                                <div class="flex items-center justify-between">
                                    <small class="m-0 text-muted">${ item.city.name }</small>
                                    <button class="btn-heart ${''}">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            style="width: 20px"
            
                                        >
                                            <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                                            />
                                        </svg>
        
                                    </button>
                                </div>
                                <h2 class="car-item-title">${ item.year } - ${ item.maker.name } ${ item.model.name }</h2>
                                <p class="car-item-price">₹${ item.price }</p>
                                <hr />
                                <p class="m-0">
                                    <span class="car-item-badge">${ item.car_type.name }</span>
                                    <span class="car-item-badge">${ item.fuel_type.name }</span>
                                </p>
                                </div>
                            </div>
                        `);
                });

                if(data['last_page'] > 1){
                    current_page = data['current_page']
                    first_page = data['first_page'] 
                    last_page = data['last_page']  
                    first_page_url = data['first_page_url'] 
                    last_page_url = data['last_page_url'] 
                    page_links = data['links'] 
                    nextPageUrl = data['next_page_url'] 
                    previousPageUrl = data['prev_page_url'] 

                    let paginationItems = ``;
                    for(let i = 1; i < page_links.length-1; i++){
                        if(page_links[i]['active']){
                            paginationItems += `<span class="pagination-item active"> ${i} </span>`
                        } else {
                            paginationItems += `<button type='button' onClick="loadpage('${page_links[i]['url']}')" class="pagination-item pageBtn"> ${i} </button type='button'>`
                        }
                    } 
                    
                    $('#searchedCars').after(`

                            <nav class="pagination my-large" id="pages">
                                ${current_page == 1 ?
                                    `<span class="pagination-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" style="width: 18px">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                        </svg>
                                    </span>`
                                :
                                    `<button type='button' onClick="loadpage('${previousPageUrl}')" class="pagination-item pageBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" style="width: 18px">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                        </svg>
                                    </button type='button'>`
                                }

                                ${paginationItems}

                                ${current_page < last_page ? `
                                    <span class="pagination-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" style="width: 18px">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </span>
                                    ` : `
                                    <button type='button' onClick="loadpage('${nextPageUrl}')" class="pagination-item pageBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" style="width: 18px">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </button type='button'>
                                    `}
                                
                            </nav>

                    `)
                }
                
            },
            error: function (error) {
                console.log('Ajax arror : ', error);
            }
        });
    });

    $('#searchResetBtn').on('click' , function () {
        $('#pages').remove();
        $('#searchedCars').html(`Loading...`);

        $.ajax({
            url: '/car-ajax/search',
            type: 'GET',
            success: function (data) {
                total = data['total'];

                $('strong#totalCars').html(total);

                $('#searchedCars').empty();
                //console.log(data);
                const cars = data['data']; 

                $.each(cars, function (index , item) {
                    let car_image = item.id > 102 ? `/storage/${ item.primary_image.image_path }`:item.primary_image.image_path

                    $('#searchedCars').append(`
                            <div class="car-item card">
                                <a href="/car/${item.id}">
                                <img
                                    src="${ car_image }"
                                    alt=""
                                    class="car-item-img rounded-t"
                                />
                                </a>
                                <div class="p-medium">
                                <div class="flex items-center justify-between">
                                    <small class="m-0 text-muted">${ item.city.name }</small>
                                    <button class="btn-heart ${''}">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            style="width: 20px"
            
                                        >
                                            <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                                            />
                                        </svg>
        
                                    </button>
                                </div>
                                <h2 class="car-item-title">${ item.year } - ${ item.maker.name } ${ item.model.name }</h2>
                                <p class="car-item-price">₹${ item.price }</p>
                                <hr />
                                <p class="m-0">
                                    <span class="car-item-badge">${ item.car_type.name }</span>
                                    <span class="car-item-badge">${ item.fuel_type.name }</span>
                                </p>
                                </div>
                            </div>
                        `);
                });

                if(data['last_page'] > 1){
                    current_page = data['current_page']
                    first_page = data['first_page'] 
                    last_page = data['last_page']  
                    first_page_url = data['first_page_url'] 
                    last_page_url = data['last_page_url'] 
                    page_links = data['links'] 
                    nextPageUrl = data['next_page_url'] 
                    previousPageUrl = data['prev_page_url'] 

                    let paginationItems = ``;
                    for(let i = 1; i < page_links.length-1; i++){
                        if (typeof page_links[i] === 'string'){
                            paginationItems += `<span class="pagination-item active"> ${page_links[i]} </span>`
                        } else {
                            if(page_links[i]['active']){
                                paginationItems += `<span class="pagination-item active"> ${i} </span>`
                            } else {
                                paginationItems += `<button type='button' onClick="loadpage('${page_links[i]['url']}')" class="pagination-item pageBtn"> ${i} </button type='button'>`
                            }
                        }
                    } 
                    
                    $('#searchedCars').after(`

                            <nav class="pagination my-large" id="pages">
                                ${current_page == 1 ?
                                    `<span class="pagination-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" style="width: 18px">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                        </svg>
                                    </span>`
                                :
                                    `<button type='button' onClick="loadpage('${previousPageUrl}')" class="pagination-item pageBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" style="width: 18px">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                        </svg>
                                    </button type='button'>`
                                }

                                ${paginationItems}

                                ${current_page < last_page ? `
                                    <span class="pagination-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" style="width: 18px">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </span>
                                    ` : `
                                    <button type='button' onClick="loadpage('${nextPageUrl}')" class="pagination-item pageBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" style="width: 18px">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </button type='button'>
                                    `}
                                
                            </nav>

                    `)
                }
                
            },
            error: function (error) {
                console.log('Ajax arror : ', error);
            }
        });
    })

    $('#signupBtn').on('click' , function() {
        
        $('#signupBtn').html('Loading...');
        const formData = $('#signupForm').serialize(); // Serialize form data
        console.log(formData);

        $.ajax({
            url: '/signup/create-user',
            type: 'POST',
            data: formData, // Send serialized form data
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('.form-group').remove();
                $('#signupBtn').remove();
                $('.social-auth-buttons').remove();
                $('.login-text-dont-have-account').remove();
                $('#signupForm').append(`
                    <div class="form-group">
                        <input name="otp" type="text" placeholder="Type 6 Digit OTP" />
                    </div>    
                    <button class="btn btn-primary btn-login w-full" id="verifyBtn">Verify</button>
                `);
                console.log('Success');
            },
            error: function (error) {
                console.log('Post Error: ', error);
            }
        });
    })

    $('.open-modal-btn').on('click', function (e) {
        $('#modalOverlay').fadeIn();
        $('#modalDeleteBtn').val(e.target.value);
    });

    $('#modalDeleteBtn').on('click' , (e) => {
        $.ajax({
            url : '/car/' + e.target.value,
            type : 'delete',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : () => {
                console.log('deleted succesfully.')
                $(`#item${e.target.value}`).hide();
            },
            error : (error) => {console.log('Error while Deleting : ' , error)}
        })
    })

    $('.closeModal, #modalOverlay').on('click', function (e) {
      if (e.target !== this) return; // prevent closing when clicking inside the modal
      $('#modalOverlay').fadeOut();
    });

    $('#findACarBtn').on('click' , () => {
        window.location.href = "/car/search"
    })

    $('#addACarBtn').on('click' , () => {
        window.location.href = "/car/create"
    })

})