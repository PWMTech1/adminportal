<script type="text/javascript">
    function LoadPDF(pdf){
        let pdfWindow = window.open("");
        pdfWindow.document.write(
            "<iframe width='100%' height='100%' src='" +
            pdf + "'></iframe>"
        );
    }
</script>

<a href="javascript:;" onclick="LoadPDF({{"'" . $file_contents . "'"}});">Open</a>