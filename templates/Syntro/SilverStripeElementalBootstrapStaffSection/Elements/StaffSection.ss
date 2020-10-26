<div class="row justify-content-center text-center">
    <% if ShowTitle || Content %>
        <div class="{$ElementName}__contentholder col-12 col-md-10 col-lg-8 mb-4">
            <% if ShowTitle %>
                <h2 class="mb-4 {$ElementName}__title">$Title</h2>
            <% end_if %>
            <% if $Content %>
            <p class="{$ElementName}__content">$Content</p>
            <% end_if %>
        </div>
    <% end_if %>
    <div class="w-100"></div>
    <% loop StaffMembers %>
        <div class="{$ElementName}__staffer col-12 col-sm-6 col-md-4 col-xl-3 d-flex flex-column align-items-center my-3">
            <div class="{$ElementName}__staffer-image px-5">
                <img src="$Image.URL" alt="$Title" class="w-75 img-fluid rounded-circle shadow">
            </div>
            <h3 class="{$ElementName}__staffer-title mt-4">$Title</h3>
            <% if Position %>
                <small class="{$ElementName}__staffer-position text-uppercase"><strong>$Position</strong></small>
            <% end_if %>
            <p class="{$ElementName}__staffer-description mt-3 px-3">$Description</p>
        </div>
    <% end_loop %>
</div>
