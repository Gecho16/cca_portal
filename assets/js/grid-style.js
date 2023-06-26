// First loop counter
var i = 0;
// Array containers
const days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
while(i < 6){
    // Fetch containers
    var x = document.getElementById(days[i]).querySelectorAll(".timeBlockInput");

    // Count number of parameters
    var paramCount = 0;
    for (let data of x) {
        paramCount++;
    // End of loop
    }
    // +1 for last vacant slot
    paramCount++;

    // Create new array to push data into
    const blockCount = [];
    // Second loop counter
    var j = 0;
    // Value total counter
    var total = 0;
    // Odd/Even determiner
    var flag = "odd";
    // First run determiner
    var start = 1;
    for (let data of x) {
        // Convert values to integer
        var value = parseInt(data.value);
        var diff = (total-parseInt(data.value));

        // Vacant = odd
        if(flag == "odd"){
            if(start != 1){
                // Minuend must have a bigger value to avoid negative values
                if(total < value){
                    diff = (parseInt(data.value)-total);
                }else{
                    diff = (total-parseInt(data.value));
                }
                // Push data to array
                blockCount.push(diff);
                total = total + diff;
            }else{
                // Push data to array
                blockCount.push(parseInt(data.value));
                total = total + parseInt(data.value);
            }
            // Reset determiner
            flag = "even";
        // Timeblocks = even
        // End of if statement
        }else{
            blockCount.push(parseInt(data.value));
            total = total + parseInt(data.value);
            // Reset determiner
            flag = "odd";
        // End of else statement
        }

        // Parameter counter
        j++;
        // Insert last vacant slot
        var lastSlot = 15-total;
        if(j == (paramCount-1)){
            // Push data to array
            blockCount.push(lastSlot);
        }
    // Reset loop
    start = 0;
    // End of loop
    }

    // Concatenate fractional sizes
    var column = "";
    var template = "";
    for (let a of blockCount) {
        // 0 = no vacant time
        if(a != 0){
            // Add fractional unit
            var block = " " + a + "fr";
            // Concatenate fractional sizes
            column = column.concat(block);
        // End of if statement
        }
    // End of loop
    }

    // Create style template
    var template = "grid-template-rows:".concat(column).trim();
    // Set style template
    document.getElementById(days[i]).style = template;
    // Increment counter
    i++;
    // End of loop
}