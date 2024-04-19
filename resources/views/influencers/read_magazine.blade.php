@extends('layouts.main')



@section('content')

    <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                            <h5 class="card-title">{{$magazine->name}}</h5>
                    </div>


                    <div class="card-body">
                        <canvas id="pdf-viewer"></canvas>

                    </div>

                </div>
            </div>


    </div>

@endsection



@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>

    <script>
        // Path to your PDF file
        const pdfPath = '{{url($magazine->file)}}';

        // Asynchronously load and render the PDF
        pdfjsLib.getDocument(pdfPath).promise.then(pdf => {
            pdf.getPage(1).then(page => {
                const canvas = document.getElementById('pdf-viewer');
                const context = canvas.getContext('2d');
                const viewport = page.getViewport({ scale: 1.5 });

                canvas.height = viewport.height;
                canvas.width = viewport.width;

                page.render({
                    canvasContext: context,
                    viewport: viewport
                });
            });
        });
    </script>
@endsection

