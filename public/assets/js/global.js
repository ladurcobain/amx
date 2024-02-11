function reload_page() {
	location.reload();	
}

function link_new_tab(url) {
	uri = url;	
	window.open(uri,'_blank', 'directories=0,titlebar=0,toolbar=0,location=0,status=0,menubar=0,scrollbars=no,resizable=no, width=770, height=500, top=20, left=80');
}

function link_to(url) {
	location.href = base_url + url;
}

function link_detail(url, id) {
	location.href = base_url + url + "/detail/" + id;
}

function link_add(url) {
	location.href = base_url + url + "/create";
}

function link_edit(url, id) {
	location.href = base_url + url + "/edit/" + id;
}

function link_delete(url, id) {
	location.href = base_url + url + "/destroy/" + id;
}

function edit_data(url, id) {
    Swal.fire({
        title: "Edit data",
        text: "Are you sure want to edit this data ?",
        icon: "warning",
        showCancelButton:!0,
        cancelButtonClass:"btn btn-danger w-xs mt-2",
        cancelButtonText: "No, cancel!",
        confirmButtonClass:"btn btn-success w-xs me-2 mt-2",
        confirmButtonText: "Yes, update it!",
        buttonsStyling: !1,
        showCloseButton: !0
    }).then(function(t) {
        if(t.value) {
            link_edit(url, id);
        }
    });
}

function delete_data(url, id) {
    Swal.fire({
        title: "Delete data",
        text: "Are you sure want to delete this data ?",
        icon: "error",
        showCancelButton:!0,
        cancelButtonClass:"btn btn-danger w-xs mt-2",
        cancelButtonText: "No, cancel!",
        confirmButtonClass:"btn btn-success w-xs me-2 mt-2",
        confirmButtonText: "Yes, delete it!",
        buttonsStyling: !1,
        showCloseButton: !0
    }).then(function(t) {
        if(t.value) {
            link_delete(url, id);
        }
    });
}


function edit_to(url) {
    Swal.fire({
        title: "Edit data",
        text: "Are you sure want to edit this data ?",
        icon: "warning",
        showCancelButton:!0,
        cancelButtonClass:"btn btn-danger w-xs mt-2",
        cancelButtonText: "No, cancel!",
        confirmButtonClass:"btn btn-success w-xs me-2 mt-2",
        confirmButtonText: "Yes, update it!",
        buttonsStyling: !1,
        showCloseButton: !0
    }).then(function(t) {
        if(t.value) {
            link_to(url);
        }
    });
}

function delete_to(url) {
    Swal.fire({
        title: "Delete data",
        text: "Are you sure want to delete this data ?",
        icon: "error",
        showCancelButton:!0,
        cancelButtonClass:"btn btn-danger w-xs mt-2",
        cancelButtonText: "No, cancel!",
        confirmButtonClass:"btn btn-success w-xs me-2 mt-2",
        confirmButtonText: "Yes, delete it!",
        buttonsStyling: !1,
        showCloseButton: !0
    }).then(function(t) {
        if(t.value) {
            link_to(url);
        }
    });
}


function show_message(message) {
	Swal.fire({
        title: "Information",
        text: message,
        icon: "info",
        confirmButtonClass: "btn btn-primary w-xs mt-2",
        buttonsStyling: !1,
        showCloseButton: !0
    }),
    function() {
        setTimeout(function() {
            swal({
			    title: "",
			    timer: 1
			});
        }, 1000);
    }
}