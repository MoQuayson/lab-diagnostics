import React, { Component } from 'react';
const UpdateLabTestModal = (props)=>{

    const FormSubmit=(e)=>{
        e.preventDefault();
    }

    //modal
    const DisplayModal = ()=>{
        return(
            <div className="modal fade" id="UpdateTest" data-bs-backdrop="static" tabIndex="-1">
                <div className="modal-dialog modal-lg">
                    <div className="modal-content">
                        <form action="#" onSubmit={FormSubmit.bind(this)} method="POST" encType="multipart/form-data">
                            <div className="modal-header">
                            <h5 className="modal-title" id="assignment_title">Update Lab Test Info.</h5>
                            <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div className='modal-body p-3'>
                                <div className="container">
                                    <input type={'hidden'} id='update_test_id' name='update_test_id'></input>
                                    <div className="col mb-3">
                                        <label className="form-label">Test Name</label>
                                        <input type="text" className="form-control" id="update_name" name="update_name" required/>
                                    </div>

                            <div className="col mb-3">
                                <label className="form-label">Price</label>
                                <input type="text" className="form-control" id="update_price" name="update_price" required/>
                            </div>

                            <div className="col mb-3">
                                <label className="form-label">Result</label>
                                <textarea className="form-control" rows="2" id="update_result" name="update_result" required></textarea>
                            </div>
                                </div>

                            </div>
                            <div className="modal-footer">
                            <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button  type="button" className="btn btn-success" onClick={UpdateDetails.bind(this)}>Save Changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        );
    }

    //functions for crud operations
    const AdminUpdateLabTest = ()=>{
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var url = window.location.origin + '/admin/lab-test/'+document.getElementById('update_test_id').value;

        let body={
            test_id:document.getElementById('update_test_id').value,
            name: document.getElementById('update_name').value,
            price:document.getElementById('update_price').value,
            result: document.getElementById('update_result').value,
            user_id:'N/A'
        }

        fetch(url, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            body: JSON.stringify(body)
        })

        .then(res => res.json())
        .then(
            (result) => {

                console.log(result);
                window.location.reload();

            },
            (error) => {
                console.log(error);
            }
        );
    }

    const UpdateLabTest = ()=>{
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var url = window.location.origin + '/lab-test/'+document.getElementById('update_test_id').value;

        let body={
            test_id:document.getElementById('update_test_id').value,
            name: document.getElementById('update_name').value,
            price:document.getElementById('update_price').value,
            result: document.getElementById('update_result').value,
            user_id:'N/A'
        }

        fetch(url, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            body: JSON.stringify(body)
        })

        .then(res => res.json())
        .then(
            (result) => {

                console.log(result);
                window.location.reload();

            },
            (error) => {
                console.log(error);
            }
        );
    }

    const UpdateDetails=()=>{
        if(props.isAdmin)
        {
            AdminUpdateLabTest();
        }
        else{
            UpdateLabTest();
        }
    }

    return <DisplayModal/>;
}

export default UpdateLabTestModal;
