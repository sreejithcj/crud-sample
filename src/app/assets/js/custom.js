$(document).ready(() => {
    getBugsList()
    getPagination()
    getProjects()
    getUsers()

    $('#bug-create-message').css("display", "none");
    $('#bug-edit-message').css("display", "none");    

    $('#create-new-bug').click((e) => {
        e.preventDefault()

        if(!$('#create-bug-form')[0].checkValidity()) {
            e.stopPropagation()
            $('#create-bug-form')[0].classList.add('was-validated')
            return false;
        }
        
        data = {
            'bugTitle': $('#bug-title').val(),
            'bugDescription': $('#bug-desc').val(),
            'bugStatus': $('#bug-status option:selected').val(),
            'projectId': $('#project option:selected').val(),
            'creatorId': $('#creator option:selected').val(),
            'ownerId': $('#owner option:selected').val(),
            'priority': $('#priority option:selected').val()
        }
        $.ajax({
            type: "post",
            data: data,
            dataType: "JSON",
            url: "create",
            success: function(data) {
              if(data.status === 200) {
                $('#bug-create-message').css("display", "block")
                $('#bug-create-message').css('opacity', 1)
                $('.form-control').val('')
                //Reset the pagination and the CurrentPage cookie to last page
                getPagination().then( () => {
                    lastPage = $('tfoot tr td span:last-child')
                    resetCurrentPage(lastPage)
                    getBugsList()
                })
                
              }
            },
            error: function(error) {
                console.log("Error creating bug.")
            }
        })
    })

    $('#editBugModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget) // Button that triggered the modal
        let bugId = button.data('bugid')
        if(bugId > 0 ) {
            var modal = $(this)
            modal.find('.modal-body #bug-id').val(bugId)
            getBugData();
        }
    })

    $('#update-bug').click( (e) => {
        e.preventDefault();
        if(!$('#edit-bug-form')[0].checkValidity()) {
            e.stopPropagation()
            $('#edit-bug-form')[0].classList.add('was-validated')
            return false;
        }

        data = {
            'bugId': $('#bug-id').val(),
            'bugTitle': $('#edit-bug-title').val(),
            'bugDescription': $('#edit-bug-desc').val(),
            'bugStatus': $('#edit-bug-status option:selected').val(),
            'projectId': $('#edit-project option:selected').val(),
            'creatorId': $('#edit-creator option:selected').val(),
            'ownerId': $('#edit-owner option:selected').val(),
            'priority': $('#edit-priority option:selected').val(),
        }

        $.ajax( {
            type: 'post',
            data: data,
            dataType:'JSON',
            url: 'update',
            success: function(data) {
                $('#bug-edit-message').css("display", "block")
                $('#bug-edit-message').css('opacity', 1)
                $('.form-control').val('')
                getBugsList()
            },
            error: function(error) {
                console.log("Failed to update the bug details");
            },
        })

    })

    $(document).on('click', '.pageNo', function(){
        resetCurrentPage(this) 
        getBugsList()
    })
});

function resetCurrentPage(spanCtrl) {
    let pageNo = $(spanCtrl).attr('id')
    $('.pageNo').removeClass('currentPageNo')
    $(spanCtrl).addClass('currentPageNo')
    createCookie('currentPage',pageNo)
}
function getBugsList() {
    let pageNo = readCookie('currentPage')
    let data = {"pageNo": pageNo}

    $.ajax({
        type: "post",
        url: "list",
        data: data,
        dataType: "JSON",
        success: function(data) {
            
            if(data.status === 200) {
                $('#bugs-list tbody tr').remove();
                let htmlContent = generateFormattedHTML(data.data)
                $('#bugs-list tbody').append(htmlContent)    
            }
        },
        error: function(error){
            console.log("Unable to retrieve the bugs list.")
        }
    });
}
function generateFormattedHTML(bugsList) {
    let htmlContent = '';
    $.each(bugsList, (index, value) => {
        htmlContent = htmlContent + `<tr>
        <th scope="row"><a class="edit-bug" data-toggle="modal" data-target="#editBugModal" data-bugid="${value.id}">${value.title}</a></th>
        <td>${value.description}</td>
        <td>${value.project_name}</td>
        <td>${value.current_status}</td>
        <td>${value.priority}</td>
        <td>${value.owner}</td>
        <td>${value.created_by}</td>
        </tr>`
    });

    return htmlContent;
}
function getProjects() {
    $.ajax( {
       type: "get",
       url: "projects",
       dataType: "JSON",
       success: function(data) {
           if(data.status === 200) {
            let projects = generateSelectOptions(data.data, 'project_name') 
            $('#project').append(projects)
            $('#edit-project').append(projects)
           }
       },
       error: function(error) {
        console.log("Failed to load Project data")
       }
    });
}

function getUsers() {
    $.ajax( {
       type: "get",
       url: "users",
       dataType: "JSON",
       success: function(data) {
           if(data.status === 200) {
            let users = generateSelectOptions(data.data, 'name') 
            $('#creator').append(users)
            $('#owner').append(users)

            $('#edit-creator').append(users)
            $('#edit-owner').append(users)
           }
       },
       error: function(error) {
        console.log("Failed to load Users data")
       }
    });
}

function generateSelectOptions(data, valueFieldName) {
    let options = '';
    options = `<option value="" selected>Select</option>`
    $.each(data, (index, value) => {
        options = options + `<option value=${value.id}>${value[valueFieldName]}</option>`
    });
    return options;
}

function getBugData() {
    let currentBugId = $('#bug-id').val();
    $.ajax({
        type:"post",
        data: { "bugId": currentBugId},
        dataType: "JSON",
        url: "details",
        success: function(data) {
            let bugData = data.data;
            $("#edit-bug-title").val(bugData[0]['title'])
            $("#edit-bug-desc").val(bugData[0]['description'])
            $("#edit-bug-status").val(bugData[0]['current_status'])
            $("#edit-project").val(bugData[0]['projectId'])
            $("#edit-creator").val(bugData[0]['creatorId'])
            $("#edit-owner").val(bugData[0]['ownerId'])
            $("#edit-priority").val(bugData[0]['priority'])
        },
        error: function(error) {
            console.log("Unable to retrieve the bug details.");
        }
    })
}

function getPagination() {
    return new Promise((resolve, reject) => {
        $.ajax({
            type:"get",
            url:"pagination",
            dataType:"JSON",
            success: function(data) {
                $('#bug-list-footer').html('');
                $('#bug-list-footer').append(data.data)
                createCookie('currentPage',1)
                //Change the css style of first page number span by default.
                $('#1').addClass('currentPageNo')
                resolve()
            },
            error: function(error) {
                console.log("Error retreiving pagination")
                reject()
            }
        })
    })      
}