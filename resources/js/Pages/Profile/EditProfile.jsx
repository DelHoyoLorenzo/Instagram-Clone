import React, { useState } from 'react'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import { Head, Link, useForm } from '@inertiajs/react';
import { router } from '@inertiajs/react'

function EditProfile({ user, profile, auth }) {

    const { data, setData, post, progress } = useForm({
        image: null,
        title: profile.title,
        description: profile.description,
        url: profile.url,
    })

    /* const handleFileChange = (e) => {
        const file = e.target.files[0];
        setForm({
            ...form,
            image: file
        });
    };

    const handleChange = (e) => {
        setForm({
            ...form,
            [e.target.name]: e.target.value,
        })
    } */

    const submit = async (e) => {
        e.preventDefault();
        /* const formData = new FormData();
        formData.append('image', form.image);
        formData.append('title', form.title);
        formData.append('description', form.description);
        formData.append('url', form.url);
        console.log(formData) */
        /* try {
            let { data } = await axios.patch(`http://localhost:8000/profile/${auth.user.id}`, formData)

            if(data){
                console.log(data);
            }
        } catch (error) {
            console.log(error);
        } */


        router.post(`http://localhost:8000/profile/${auth.user.id}`, data, {
            _method: 'patch',
            forceFormData: true,
        })
    };

  return (
    <AuthenticatedLayout user={auth.user}>
        <div className="container py-4">
            <form onSubmit={submit} encType="multipart/form-data">
                <div className="row">
                    <div className="col-8">
                        <div className="row mb-3">
                            <div className="row">
                                <h1 className="fw-bold text-white">Edit Profile</h1>
                            </div>
                            <div className="d-flex align-items-center justify-content-between rounded py-3 my-4 bg-[#262626]">
                                <div className="col-6 d-flex align-items-center">
                                    <img className="w-25 rounded-circle" src={`/storage/${profile?.image}`} alt="user-profile-image" />
                                    <div className="d-flex flex-column m-1">
                                        <h3 className='text-white'>{ user.username }</h3>
                                        <p className='text-white'>{ user.profile.description }</p>
                                    </div>
                                </div>

                                <input onChange={e => setData('image', e.target.files[0])} className="btn btn-primary" type="file" /* name="image" id="image" */ />
                            </div>

                            <div className="form-group row text-white">
                                <label for="title" className="col-md-4 col-form-label">Title</label>
                                <input onChange={e => setData('title', e.target.value)} id="title" 
                                type="text" 
                                className="bg-black text-white rounded-lg border-[#323539]" name="title" value={data.title}
                                autocomplete="title" autofocus /> 
                        
                            </div>
                            <div className="form-group row text-white">
                                <label for="description" className="col-md-4 col-form-label ">Description</label>
                                <input onChange={e => setData('description', e.target.value)} id="description" 
                                type="text" 
                                className="bg-black text-white rounded-lg border-[#323539]" name="description" value={data.description}
                                autocomplete="description" autofocus />
                        
                            </div>
                            <div class="form-group row text-white">
                                <label for="url" className="col-md-4 col-form-label">URL</label>
                                <input onChange={e => setData('url', e.target.value)} id="url" 
                                type="text" 
                                className="bg-black text-white rounded-lg border-[#323539]" name="url" value={data.url}
                                autocomplete="url" autofocus />
                    
                            </div>

                        </div>
                    </div>
                </div>

                <div className="row w-25 pt-4">
                    <button type="submit" className="bg-[#1877F2] p-2 rounded-md text-white">Submit</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
  )
}

export default EditProfile