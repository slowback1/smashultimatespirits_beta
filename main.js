//contains js that's used throughout the site
// TODO: make sure this is properly imported get_spirit.js
//           (header.php appears to be working)

//total number of spirits in the site, needs to be updated manually
const max = 1320;

//prevents function from firing repeatedly
//arg func: a function
//arg limit: integer representing cooldown in ms
//return: a function which prevents the passed function from firing twice within the limit
const throttle = (func, limit) => {
    let lastFunc;
    let lastRan;

    return function() {
        const context = this;
        const args = arguments;
        if(!lastRan) {
            func.apply(context,args);
            lastRan = Date.now();
        } else {
            clearTimeout(lastFunc);
            lastFunc = setTimeout(function() {
                if((Date.now() - lastRan) >= limit) {
                     func.apply(context, args);
                     lastRan = Date.now();
                }
            }, limit - (Date.now() - lastRan));
        }
    }
}
