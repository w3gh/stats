// API examples
$('table td.example:not(:empty)').each(function()
{
   var self = this;

   // Setup title
   var header = $(self).parents('tr + .optionhead:first td.name').text().replace(': {', '');
   var title = 'Example: ' + ((header) ? header+'.' : '') + $(self).siblings('td:first').text();

   $(self).qtip({
      content: {
         text: $(self).html(),
         title: {
            text: title
         }
      },
      position: {
         corner: {
            target: 'leftMiddle',
            tooltip: 'rightMiddle'
         }
      },
      show: 'click',
      hide: 'unfocus',
      style: {
         border: {
            width: 5
         },
         tip: {
            corner: 'rightMiddle'
         },
         name: 'green',
         width: {
            max: 650,
            min: 500
         },
         padding: 14
      },
      api: {
         onRender: function()
         {
            hljs.initHighlightingOnLoad('javascript');
         }
      }
   })
   .html('Example')
   .show();
});

// Anchor names
$('a[name]').each(function()
{
   var self = this;

   //Find the nearest suitable element
   var sibling = $(self).siblings(':header').add( $(self).closest('td') ).eq(0);

   sibling.qtip({
         content: '#' + $(self).attr('name'),
         position: {
            corner: {
               target: 'leftMiddle',
               tooltip: 'rightMiddle'
            },
            adjust: { x: -10 }
         },
         hide: {
            fixed: true,
            delay: 240
         },
         style: {
            border: 1,
            cursor: 'pointer',
            padding: '5px 8px',
            name: 'blue'
         },
         api: {
            onRender: function()
            {
               this.elements.tooltip.click(function()
               {
                  document.location.hash = $(self).attr('name');
               });
            }
         }
      })
});