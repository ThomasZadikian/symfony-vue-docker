export function setup(): void {
  global.CSS = {
    ...global.CSS,
    supports: (_str: string) => false,
    escape: (str: string) => str,
  };
}
