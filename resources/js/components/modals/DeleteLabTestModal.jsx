import React, { Component } from 'react';
const DeleteLabTestModal = (props)=>{

    const FormSubmit=(e)=>{
        e.preventDefault();
    }

    // modal
    const DisplayModal = ()=>{
        return(
            <div className="modal fade" id="DeleteTest" data-bs-backdrop="static" tabIndex="-1">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <form action="#" onSubmit={FormSubmit.bind(this)} method="POST" encType="multipart/form-data">
                            <div className="modal-header">
                            <h5 className="modal-title" id="assignment_title">Delete Appointment</h5>
                            <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div className='modal-body p-3'>
                                <input type={'hidden'} id='test_id' name='test_id'></input>
                                <p>Are you sure you want to delete cuurent lab test info.?</p>
                            </div>
                            <div className="modal-footer border-0">
                            <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="deletebtn" type="button" className="btn btn-primary" onClick={DeleteDetails.bind(this)}>Confirm Changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        );
    }

    //functions for crud operations
    const AdminDeleteTest=()=>{
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var url = window.location.origin + '/admin/lab-test/'+document.getElementById('test_id').value;
        fetch(url, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            //body: JSON.stringify(body)
        })

        .then(res => res.json())
        .then(
            (result) => {

                window.location.reload();

            },
            (error) => {
                console.log(error);
            }
        );
    }

    const DeleteTest=()=>{
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var url = window.location.origin + '/lab-test/'+document.getElementById('test_id').value;
        fetch(url, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            //body: JSON.stringify(body)
        })

        .then(res => res.json())
        .then(
            (result) => {

                window.location.reload();

            },
            (error) => {
                console.log(error);
            }
        );
    }

    const DeleteDetails=()=>{
        if(props.isAdmin)
        {
            AdminDeleteTest();
        }
        else{
            DeleteTest();
        }
    }

    return <DisplayModal/>;
}

export default DeleteLabTestModal;
