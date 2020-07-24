function loadUltimosCadastrados(tipo, qtd){
    var data_chart1 = { 
        labels : [], 
        datasets : [{
            label: "Cadastrados",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: []
        },
        {
            label: "Atualizados",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: []
        }]
    };
    var max = 0;
    $.ajax({
    	type: 'POST',
    	url: base_url + 'candidatos/getUltimosCadastros/' + tipo + '/' + qtd,
    	dataType: 'json',
    	async: false,
    	success: function(data){
            $(data).each(function(i, e){
                max = (max < e.qtd_cadastrados) ? e.qtd_cadastrados : max;
                max = (max < e.qtd_atualizados) ? e.qtd_atualizados : max;

                data_chart1.labels.push(e.data);
                data_chart1.datasets[1].data.push(parseInt(e.qtd_cadastrados));
                data_chart1.datasets[0].data.push(parseInt(e.qtd_atualizados));
    		});
    	}
    });
    var chart1 = $("#chart-1").get(0).getContext("2d");

    var width = Math.ceil(max/10);
    var scale = Math.ceil(max/width);

    new Chart(chart1).Line(data_chart1, {
        scaleOverride: true,
        scaleSteps: scale,
        scaleStepWidth: width,
        scaleStartValue: 0,
        bezierCurve : false
    });
}

var data_chart2 = [];
dch2_colors = ["#F7464A", "#46BFBD", "#FDB45C"];
dch2_highlights = ["#FF5A5E", "#5AD3D1", "#FFC870"];
dch2_dark = ["#c43739", "#348c8b", "#e3a252"];
$.ajax({
    type: 'POST',
    url: base_url + 'processosseletivos/getGraficoEstados',
    dataType: 'json',
    async: false,
    success: function(data){
        $(data).each(function(i, e){
            data_chart2.push({
                value: parseInt(e.qtd),
                label: e.situacao,
                color: dch2_colors[i],
                highlight: dch2_highlights[i]
            });
            $('#chart-2 ~ .legenda-div').append('\
                <div class="legenda">\
                    <div class="cor" style="background-color:'+dch2_colors[i]+';border:2px solid '+dch2_dark[i]+';"></div>\
                    <div class="rotulo">'+e.situacao+'</div>\
                </div>\
            ');
        });
    }
});
var chart2 = $("#chart-2").get(0).getContext("2d");
var my_chart2 = new Chart(chart2).Pie(data_chart2, {
    barShowStroke: false
});

$('document').ready(function(){
    
    var tipo = 'd';
    loadUltimosCadastrados(tipo, 7);
    
    $('#alterar-visualizacao').html('<i class="fa fa-dot-circle-o"></i>Visualizar último semestre') .click(function(){
        if(tipo == 'd') {
            tipo = 'm';
            $(this).html('<i class="fa fa-dot-circle-o"></i>Visualizar última semana');
            loadUltimosCadastrados(tipo, 6);
        } else {
            tipo = 'd';
            $(this).html('<i class="fa fa-dot-circle-o"></i>Visualizar último semestre');
            loadUltimosCadastrados(tipo, 7);
        }
    });
});