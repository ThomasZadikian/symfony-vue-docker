import { describe, it, expect, vi, beforeEach, afterEach } from 'vitest';
import debounce from '../functions/debounce';

describe('debounce', () => {
  beforeEach(() => {
    vi.useFakeTimers();
  });

  afterEach(() => {
    vi.useRealTimers();
  });

  it('should call the function after the wait time if not called again', () => {
    const func = vi.fn();
    const debouncedFunc = debounce(func, 2000);

    debouncedFunc('test');

    expect(func).not.toHaveBeenCalled();

    vi.advanceTimersByTime(1500);
    expect(func).not.toHaveBeenCalled();

    vi.advanceTimersByTime(500);
    expect(func).toHaveBeenCalledTimes(1);
    expect(func).toHaveBeenCalledWith('test');
  });

  it('should cancel previous calls when invoked repeatedly', () => {
    const func = vi.fn();
    const debouncedFunc = debounce(func, 2000);

    debouncedFunc('first');
    vi.advanceTimersByTime(1000);

    debouncedFunc('second');
    vi.advanceTimersByTime(1500);

    expect(func).not.toHaveBeenCalled();

    vi.advanceTimersByTime(500);
    expect(func).toHaveBeenCalledTimes(1);
    expect(func).toHaveBeenCalledWith('second');
  });
});
