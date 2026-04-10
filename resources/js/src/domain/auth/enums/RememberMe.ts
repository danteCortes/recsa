export const RememberMe = {
    YES: 'SI',
    NO: 'NO'
} as const;

export type RememberMe = typeof RememberMe[keyof typeof RememberMe];