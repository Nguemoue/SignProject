@extends('template')

@section('main')

    <!-- ================ category section start ================= -->
    <section class="section-margin--small" style="margin-top: 3px" >
        @livewire("category-livewire")
    </section>
    <!-- ================ category section end ================= -->

    <script>
        const likeableButtons = document.querySelectorAll('.ti-heart.likeable')
        likeableButtons.forEach(button=>{
            button.addEventListener('click',function (event){
                let target = event.target
                console.log(target)
                if(target.classList.contains('liked')){
                    target.classList.remove('liked')
                    alert('disliked')
                }else{
                    target.classList.add('liked')
                    alert('liked')
                }
            })
        })
    </script>
@endsection 

@push("styles")
    <style>
        .ti-heart.liked{
            font-weight: bolder;
            color: red;
        }
    </style>
@endpush