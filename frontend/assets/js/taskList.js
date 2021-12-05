const taskList = {
    init:function(){
        const allTaskElement = document.querySelectorAll('.tasks .task');
        for (const taskElement of allTaskElement){
            taskElement.init(taskElement);
        }
    }
}