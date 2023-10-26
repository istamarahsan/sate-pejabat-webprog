@extends('layouts.dashboard')
@section('child-content')
    <script>
        document.addEventListener("DOMContentLoaded", (e) => {
            const axios = window.axios
            axios.get("/admin/api/cashflow").then((response) => console.log(JSON.stringify(response.data)))
        })
    </script>
@endsection