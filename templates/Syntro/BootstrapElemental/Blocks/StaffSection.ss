
<div class="py-5 container text-center">
    <div class="row my-5 justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 mb-4">
            <% if ShowTitle %>
                <h2 class="mb-4">$Title</h2>
            <% end_if %>
            <p>$Content</p>
        </div>
        <div class="w-100"></div>
        <% loop StaffMembers %>
            <div class="col-12 col-sm-6 col-md-4 col-xl-3 d-flex flex-column align-items-center my-3">
                <div class="px-5">
                    <img src="$Image.URL" alt="$Title" class="w-75 img-fluid rounded-circle shadow">
                </div>
                <h3 class="mt-4">$Title</h3>
                <% if Position %>
                <lead><strong>$Position</strong></lead>
                <% end_if %>
            <p class="mt-3 px-3">$Description</p>
            </div>
        <% end_loop %>
    </div>
</div>
