using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;

namespace day2
{
    internal class Program
    {
        static void Main(string[] args)
        {
            string input = @"day2.txt";
            List<long> numbers = new List<long>();
            List<long> numbers2 = new List<long>();

            if (File.Exists(input))
            {
                foreach (var i in File.ReadAllText(input).Split(','))
                {
                    var range = i.Split('-');
                    long start = long.Parse(range[0]);
                    long end = long.Parse(range[1]);

                    for (long j = start; j <= end; j++)
                    {
                        string st = j.ToString();
                        if(st.Length >= 2 && Regex.IsMatch(st, @"^(\d+)\1+$"))
                        {
                            numbers2.Add(j);
                        }

                        if (st.Length % 2 == 0)
                        {
                            int half = st.Length / 2;
                            string first = st.Substring(0, half);
                            string second = st.Substring(half);

                            if (first == second)
                            {
                                numbers.Add(j);
                            }
                        }
                    }
                }
                Console.WriteLine($"part 1: {numbers.Sum()}");
                Console.WriteLine($"part 2: {numbers2.Sum()}");
                Console.ReadLine();
            }
            else
            {
                Console.WriteLine("File not found");
            }
        }
    }
}
