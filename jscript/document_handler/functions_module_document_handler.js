        function adaptContainerDimensionAsCurrentWindow(container_id) {
            var target_width = window.innerWidth;
            var target_height = window.innerHeight;
            var width_adjustment = -20;
            var height_adjustment = 60;

            target_width -= (window.outerWidth - target_width);
            target_height -= (window.outerHeight - target_height);

            target_width += width_adjustment;
            target_height += height_adjustment;

            document.getElementById(container_id).style.width = target_width + 'px';
            document.getElementById(container_id).style.height = target_height + 'px';
        }


        function initProgram() {
            initPageInputBlocker(); 
            adaptContainerDimensionAsCurrentWindow('document_handler_form_container_area');

            initInputElementsFormEntities();
            initialiseDocumentHandlerFormLayout();
            closeEntitySearchForm();

            // window.onfocus = function() {
            //     refreshEntityFilePropertiesToFields();
            // };
        }
