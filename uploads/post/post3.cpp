//Unlimited coin
#include <stdio.h>
int dp[1000];
int main()
{
    int i, j, coin[10], n, taka, add=0;
    dp[0]=1;
    printf("Enter the number of coins:");
    scanf("%d", &n);
    printf("Enter the value of coins:\n");
    for(i=1; i<=n; i++)
    {
        scanf("%d", &coin[i]);
    }
    for(i=1; i<=n; i++)
    {
        add=add+coin[i];
    }
    for(i=1; i<=n; i++)
    {
        for(j=0; j<=add; j++)
        {
            if(dp[j]==1)
            {
                dp[j+coin[i]]++;
            }
        }
    }
    while(true)
    {
        printf("\n\nEnter your amount:");
        scanf("%d", &taka);
        if(dp[taka]>0) printf("Yes");
        else printf("No");
    }
}
