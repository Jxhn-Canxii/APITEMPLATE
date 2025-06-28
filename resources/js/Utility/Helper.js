export const useDebounce = (func, delay) => {
    //use delay if you want a custom delay debounce
    let timer;
    return function (...args) {
      clearTimeout(timer);
      timer = setTimeout(() => {
        func(...args);
      }, 800);
    };
  };