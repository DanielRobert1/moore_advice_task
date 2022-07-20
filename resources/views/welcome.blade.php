<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Moore Advise Task - by Daniel Robert</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            var baseURL = '{{url('/')}}/api';
            
            function getTasks(){
                var tasksWrapper = $("#tasks-wrapper");
                tasksWrapper.html('');
                $.ajax({
                    type: "get",
                    data: {},
                    cache: false,
                    url: baseURL+"/tasks",
                    dataType: "json",
                    error: function (request, error) {
                        alert(" Error: " + request.message);
                    },
                    success: function (request) {
                      var data = request.data;
                      if(request.status == 'success'){
                        var count = 1;
                        data.forEach(element => {
                          tasksWrapper.append(`
                          <tr>
                              <th scope="row">${count}</th>
                              <td>${element.name}</td>
                              <td>${element.desc}</td>
                              <td>
                                  <button onClick="deleteTask(${element.id})" class="btn btn-danger">Delete</button>
                              </td>
                          </tr>
                          `);
                          count++;
                        });
                      }else {
                        alert(request.message);
                      }
                     // console.log(request);
                    }
                });
                
            }
            
            function deleteTask(id){
              $.ajax({
                    type: "post",
                    data: {
                      "_method": "delete",
                      id: id,
                    },
                    cache: false,
                    url: baseURL+"/tasks/"+id,
                    dataType: "json",
                    error: function (request, error) {
                        alert("Error : " + error);
                        console.log(request);
                    },
                    success: function (request) {
                      console.log(request);
                      var data = request.data;
                      if(request.status == 'success'){
                        alert(request.message);
                        getTasks();
                      }else {
                        alert(request.message);
                      }
                     console.log(request);
                    }
                });
            }

            function addTask(){
              var name = $("#name");
              var desc = $("#desc");

              $.ajax({
                    type: "post",
                    data: {
                      name: name.val(),
                      desc: desc.val(),
                    },
                    cache: false,
                    url: baseURL+"/tasks/store",
                    dataType: "json",
                    error: function (request, error) {
                        alert("Error : " + error);
                        console.log(request);
                    },
                    success: function (request) {
                      console.log(request);
                      var data = request.data;
                      if(request.status == 'success'){
                        alert(request.message);
                        getTasks();
                        name.val('');
                        desc.val('');
                      }else {
                        alert(request.message);
                      }
                     console.log(request);
                    }
                });
            }
            
            $(function(){
                $.ajaxSetup({
                    headers: {
                        
                    }
                });
                
                getTasks();
            });
        </script>
    </head>
    <body>
        <main>
         
            <section class="vh-100 pb-3" style="background-color: #eee; overflow: auto;">
                <div class="container py-5 h-100">
                  <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-lg-10 col-xl-7">
                      <div class="card rounded-3">
                        <div class="card-body p-4">
              
                          <h4 class="text-center my-3 pb-3">Moore Advice Tasks</h4>
              
                          <div class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2">
                            <div class="col-12">
                              <div class="form-outline">
                                <input type="text" id="name" placeholder="Name" class="form-control mb-1" />
                                <textarea type="text" id="desc" placeholder="Desc" class="form-control"></textarea>
                              </div>
                            </div>
              
                            <div class="col-12">
                              <button onclick="addTask()" class="btn btn-primary">Save</button>
                            </div>
                          </div>
              
                          <table class="table mb-4">
                            <thead>
                              <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Todo item</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                              </tr>
                            </thead>
                            <tbody id="tasks-wrapper">
                              
                            </tbody>
                            <tfoot>
                                
                            </tfoot>
                          </table>
              
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
        </main>
    </body>
</html>
