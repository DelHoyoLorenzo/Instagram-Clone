<div class="d-flex gap-3 my-2">
    <div onclick="likePost({{ $post_id }})" id="like-button-{{ $post_id }}">
        <svg width="25" viewBox="0 0 32 32" enable-background="new 0 0 32 32" id="Stock_cut" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><desc></desc><path d="M28.343,17.48L16,29 L3.657,17.48C1.962,15.898,1,13.684,1,11.365v0C1,6.745,4.745,3,9.365,3h0.17c2.219,0,4.346,0.881,5.915,2.45L16,6l0.55-0.55 C18.119,3.881,20.246,3,22.465,3h0.17C27.255,3,31,6.745,31,11.365v0C31,13.684,30.038,15.898,28.343,17.48z" fill="none" stroke="#ffffff" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"></path></g></svg>
    </div>
</div>

<div>
    <form class="d-flex align-items-baseline justify-content-between" action="/like/{{ $post->id }}" enctype="multipart/form-data" method="post">
        @csrf
        <input class="bg-body text-primary border-0" style="border:none; " id="comment" type="radio" class="form-control name="like" value="{{ old('like') }}" autofocus>
    </form>
</div>

{{-- <script>
    const likePost = (id) =>
        {
            console.log( id )
            axios.post(`/like/${id}`)
            .then(response => {
                console.log(response.data)
            })
            .catch(errors => {
                
            });
        }

</script> --}}