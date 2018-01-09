$(document).ready(function(){
    // Our data renderer function, returns an array of the form:
    // [[[x1, sin(x1)], [x2, sin(x2)], ...]]
    var sineRenderer = function() {
      var data = [[]];
      for (var i=0; i<13; i+=0.5) {
        data[0].push([i, Math.sin(i)]);
      }
      return data;
    };
   
    // we have an empty data array here, but use the "dataRenderer"
    // option to tell the plot to get data from our renderer.
    var plot1 = $.jqplot('chart1',[],{
        title: 'Sine Data Renderer',
        dataRenderer: sineRenderer
    });
  });
  